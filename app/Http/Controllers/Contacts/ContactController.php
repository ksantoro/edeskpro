<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\ContactAssignRequest;
use App\Http\Requests\Contacts\ContactSearchRequest;
use App\Http\Requests\Contacts\ContactStoreRequest;
use App\Http\Requests\Contacts\ContactUpdateRequest;
use App\Mail\Contacts\ContactCreate;
use App\Mail\Contacts\ContactUpdate;
use App\Mail\Contacts\ContactDelete;
use App\Models\Main\EntityType;
use App\Models\Tenant\Activity\ActivityLog;
use App\Models\Tenant\Activity\ContactActivityLog;
use App\Models\Tenant\Contact;
use App\Models\Tenant\Location;
use App\Models\Tenant\Notes;
use App\Models\Main\ContactMethodType;
use App\Models\Main\ContactType;
use App\Models\Main\LeadSource;
use App\Models\Main\NotificationSendType;
use App\Models\Main\NotificationType;
use App\Models\Main\States;
use App\Models\Tenant\NotificationUser;
use App\Models\Main\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    use SoftDeletes, SerializesModels;

    const
        TYPE_LEAD     = 1,
        TYPE_OPP      = 2,
        TYPE_CUSTOMER = 3;

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function index()
    {
        $contacts = Contact::all()->sortByDesc('created_at');

        return view('contacts.index')
            ->with('contacts', $contacts)
            ->with('counts', $this->contact_counts());
    }

    public function search(ContactSearchRequest $request)
    {
        $valid    = $request->validated();
        $contacts = Contact::where('first_name', 'LIKE', "%{$valid['search_term']}%")
            ->orWhere('last_name', 'LIKE', "%{$valid['search_term']}%")
            ->orWhere('phone', 'LIKE', "%{$valid['search_term']}%")
            ->orWhere('email', 'LIKE', "%{$valid['search_term']}%")
            ->get();

        return view('contacts.index')
            ->with('contacts', $contacts)
            ->with('counts',   $this->contact_counts());
    }

    private function contact_counts()
    {
        $contacts            = Contact::all();
        $counts              = [];
        $counts['all']       = count($contacts);
        $counts['leads']     = count($contacts->where('contact_type_id', '=', self::TYPE_LEAD));
        $counts['opps']      = count($contacts->where('contact_type_id', '=', self::TYPE_OPP));
        $counts['customers'] = count($contacts->where('contact_type_id', '=', self::TYPE_CUSTOMER));

        return $counts;
    }

    public function leads()
    {
       $contacts = Contact::all()->where('contact_type_id', '=', self::TYPE_LEAD);
       return view('contacts.index')->with('contacts', $contacts)->with('counts', $this->contact_counts());
    }

    public function opportunities()
    {
        $contacts = Contact::all()->where('contact_type_id', '=', self::TYPE_OPP);
        return view('contacts.index')->with('contacts', $contacts)->with('counts', $this->contact_counts());
    }

    public function customers()
    {
        $contacts = Contact::all()->where('contact_type_id', '=', self::TYPE_CUSTOMER);
        return view('contacts.index')->with('contacts', $contacts)->with('counts', $this->contact_counts());
    }

    public function archived_contacts()
    {
        $contacts = Contact::all()->where('deleted_at', '!=', 'null');
        return view('contacts.index')->with('contacts', $contacts)->with('counts', $this->contact_counts());
    }

    public function create()
    {
        return view('contacts.create', [
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_sources'      => LeadSource::all(),
            'contact_types'        => ContactType::all(),
            'states'               => States::all(),
        ]);
    }

    public function store(ContactStoreRequest $request)
    {
        Log::debug($request);

        $valid = $request->validated();

        // Contact Basic Info
        //
        $contact                  = new Contact;
        $contact->contact_type_id = $valid['contact_type_id'];
        $contact->first_name      = $valid['first_name'];
        $contact->last_name       = $valid['last_name'];
        $contact->title           = $valid['title'];
        $contact->email           = $valid['email'];
        $contact->email_type_id   = $valid['email_type_id'];
        $contact->phone           = $valid['phone'];
        $contact->phone_type_id   = $valid['phone_type_id'];
        $contact->save();

        // Contact Owner
        //
        if ($valid['contact_owner_id']) {
           $contact->contact_owners()->attach($valid['contact_owner_id']);
        }

        // Contact Source
        //
        if ($valid['contact_source']) {
            $contact->lead_source()->attach($valid['contact_source']);
        }

        // Contact Billing Info
        //
        $billing = new Location;
        $billing->contact_id             = $contact->id;
        $billing->is_billing             = 1;
        $billing->contact_method_type_id = $valid['billing_address_type'];
        $billing->street                 = $valid['billing_street'];
        $billing->suite                  = $valid['billing_suite'];
        $billing->city                   = $valid['billing_city'];
        $billing->state                  = $valid['billing_state'];
        $billing->zip                    = $valid['billing_zip'];
        $billing->save();

        // Contact Delivery Info
        //
        $delivery                         = new Location;
        $delivery->contact_id             = $contact->id;
        $delivery->is_billing             = 0;
        $delivery->contact_method_type_id = $valid['delivery_address_type'];
        $delivery->street                 = $valid['delivery_street'];
        $delivery->suite                  = $valid['delivery_suite'];
        $delivery->city                   = $valid['delivery_city'];
        $delivery->state                  = $valid['delivery_state'];
        $delivery->zip                    = $valid['delivery_zip'];
        $delivery->save();

        // Send Notifications
        //
        if ($valid['contact_owner_id']) {
            Mail::to(User::find($valid['contact_owner_id']))->send(new ContactCreate($contact));
        }

        try {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(1), NotificationSendType::find(2))) {
                foreach ($users_to_notify as $user_to_notify) {
                    Mail::to(User::find($user_to_notify))->send(new ContactCreate($contact));
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug(__METHOD__ . ' - Exception - ' . $exception->getMessage());
        }

        // Activity Log
        //
        try {
            $log            = new ContactActivityLog();
            $log->entity_id = $contact->id;
            $log->note      = 'Contact created in the system';
            $log->save();

            if ($valid['contact_owner_id']) {
                $owner          = User::find($valid['contact_owner_id']);
                $log            = new ContactActivityLog();
                $log->entity_id = $contact->id;
                $log->note      = "Contact assigned to owner: {$owner->first_name} {$owner->last_name}";
                $log->save();
            }
        }
        catch(\Exception $e) {
            Log::debug(__METHOD__. ' Error - ' . $e->getMessage());
        }

        // Notes
        //
        if (! empty($valid['notes'])) {
            try {
                $note                 = new Notes();
                $note->entity_type_id = EntityType::CONTACT;
                $note->entity_id      = $contact->id;
                $note->note           = $valid['notes'];
                $note->user_id        = Auth::user()->id;
                $note->created_at     = Carbon::now();
                $note->save();
            }
            catch(\Exception $e) {
                Log::debug(__METHOD__. ' Error - ' . $e->getMessage());
            }
        }

        return redirect()->route('contacts.show', [$contact->id]);
    }

    public function show($id)
    {
        $activity = [];
        $notes    = [];
        $contact  = new Contact;
        $contact  = $contact->find($id);

        if ($log = ActivityLog::contact($contact)->orderBy('created_at', 'desc')->get()) {
            foreach ($log as $item) {
                $user       = User::find($item->user_id);
                $activity[] = [
                    'note' => $item->note,
                    'ts'   => $item->created_at,
                    'user' => "{$user->first_name} {$user->last_name}",
                ];
            }
        }

        if ($contact_notes = Notes::contact($contact)->orderBy('created_at', 'desc')->get()) {
            foreach ($contact_notes as $item) {
                $user    = User::find($item->user_id);
                $notes[] = [
                    'note' => $item->note,
                    'ts'   => $item->created_at,
                    'user' => "{$user->first_name} {$user->last_name}",
                ];
            }
        }

        return view('contacts.show', [
            'contact'              => $contact,
            'contact_owner'        => $contact->contact_owners()->first(),
            'contact_source'       => $contact->lead_source()->first(),
            'contact_type'         => ContactType::find($contact->contact_type_id),
            'billing'              => Location::forContact($contact)->isBilling()->first(),
            'delivery'             => Location::forContact($contact)->isDelivery()->first(),
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_sources'      => LeadSource::all(),
            'contact_types'        => ContactType::all(),
            'activity'             => $activity,
            'notes'                => $notes,
        ]);
    }

    public function edit($id)
    {
        $contact = new Contact;
        $contact = $contact->find($id);

        return view('contacts.edit', [
            'contact'              => $contact,
            'contact_owner'        => $contact->contact_owners()->first(),
            'contact_source'       => $contact->lead_source()->first(),
            'billing'              => Location::forContact($contact)->isBilling()->first(),
            'delivery'             => Location::forContact($contact)->isDelivery()->first(),
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_sources'      => LeadSource::all(),
            'contact_types'        => ContactType::all(),
            'states'               => States::all(),
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Contact  $contact
    * @return \Illuminate\Http\Response
    */
    public function update(ContactUpdateRequest $request, $id)
    {
        Log::debug($request);

        $updated = [];
        $valid   = $request->validated();

        // Contact Basic Info
        //
        $contact                  = Contact::find($id);
        $contact_original         = $contact->getOriginal();
        $contact->contact_type_id = $valid['contact_type_id'];
        $contact->first_name      = $valid['first_name'];
        $contact->last_name       = $valid['last_name'];
        $contact->title           = $valid['title'];
        $contact->email           = $valid['email'];
        $contact->email_type_id   = $valid['email_type_id'];
        $contact->phone           = $valid['phone'];
        $contact->phone_type_id   = $valid['phone_type_id'];
        $contact->save();

        if ($changes = $contact->getChanges()) {
            foreach ($changes as $prop => $new_value) {
                if ($prop != 'updated_at') {
                    $updated[] = 'Updated ' . str_replace('_', ' ', $prop) . ' from ' . $contact_original[$prop] . " to {$new_value}";
                }
            }
        }

        // Contact Owner
        //
        if ($valid['contact_owner_id']) {
            if ($contact->contact_owners()->first()) {
                if ($valid['contact_owner_id'] != $contact->contact_owners()->first()->id) {
                    $owner     = User::find($valid['contact_owner_id']);
                    $updated[] = "Contact assigned to new owner: {$owner->first_name} {$owner->last_name}";
                    $contact->contact_owners()->detach();
                    $contact->contact_owners()->attach($valid['contact_owner_id']);
                }
            }
            else {
                $owner     = User::find($valid['contact_owner_id']);
                $updated[] = "Contact assigned to new owner: {$owner->first_name} {$owner->last_name}";
                $contact->contact_owners()->attach($valid['contact_owner_id']);
            }
        }

        // Contact Source
        //
        if ($valid['contact_source']) {
            if ($contact->lead_source()->first()) {
                $source = LeadSource::find($contact->lead_source()->first()->id);

                if ($valid['contact_source'] != $source->id) {
                    $new_source = LeadSource::find($valid['contact_source']);
                    $updated[]  = "Contact source changed from [{$source->name} {$source->description}] to [{$new_source->name} {$new_source->description}]";
                    $contact->lead_source()->detach();
                    $contact->lead_source()->attach($valid['contact_source']);
                }
            }
            else {
                $new_source = LeadSource::find($valid['contact_source']);
                $updated[]  = "Contact source changed from [Unknown] to [{$new_source->name} {$new_source->description}]";
                $contact->lead_source()->attach($valid['contact_source']);
            }
        }

        // Contact Billing Info
        //
        $billing                         = Location::forContact($contact)->isBilling()->first();
        $billing_original                = $billing->getOriginal();
        $billing->contact_id             = $contact->id;
        $billing->is_billing             = 1;
        $billing->contact_method_type_id = $valid['billing_address_type'];
        $billing->street                 = $valid['billing_street'];
        $billing->suite                  = $valid['billing_suite'];
        $billing->city                   = $valid['billing_city'];
        $billing->state                  = $valid['billing_state'];
        $billing->zip                    = $valid['billing_zip'];
        $billing->save();

        // Contact Delivery Info
        //
        $delivery                         = Location::forContact($contact)->IsDelivery()->first();
        $delivery_original                = $billing->getOriginal();
        $delivery->contact_id             = $contact->id;
        $delivery->is_billing             = 0;
        $delivery->contact_method_type_id = $valid['delivery_address_type'];
        $delivery->street                 = $valid['delivery_street'];
        $delivery->suite                  = $valid['delivery_suite'];
        $delivery->city                   = $valid['delivery_city'];
        $delivery->state                  = $valid['delivery_state'];
        $delivery->zip                    = $valid['delivery_zip'];
        $delivery->save();

        if ($changes = $billing->getChanges()) {
            foreach ($changes as $prop => $new_value) {
                if ($prop != 'updated_at') {
                    $updated[] = 'Updated billing ' . str_replace('_', ' ', $prop) . ' from ' . $billing_original[$prop] . " to {$new_value}";
                }
            }
        }

        if ($changes = $delivery->getChanges()) {
            foreach ($changes as $prop => $new_value) {
                if ($prop != 'updated_at') {
                    $updated[] = 'Updated delivery ' . str_replace('_', ' ', $prop) . ' from ' . $delivery_original[$prop] . " to {$new_value}";
                }
            }
        }

        if (! empty($updated)) {
            foreach ($updated as $note) {
                $log            = new ContactActivityLog();
                $log->entity_id = $contact->id;
                $log->note      = $note;
                $log->save();
            }

            try {
                if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(2), NotificationSendType::find(2))) {
                    foreach ($users_to_notify as $user_to_notify) {
                        Mail::to(User::find($user_to_notify))->send(new ContactUpdate($contact, $updated));
                    }
                }
            }
            catch (\Exception $exception) {
                Log::debug(__METHOD__ . ' - Exception - ' . $exception->getMessage());
            }
        }

       return redirect()->route('contacts.show', [$contact->id]);
    }

    public function assign(ContactAssignRequest $request)
    {
        $return  = [
            'message' => 'There was an error assigning lead.',
            'valid'   => false,
        ];
        $valid   = $request->validated();
        $contact = Contact::find($valid['contact_id']);
        $user    = User::find($valid['contact_owner_id']);
        $contact->contact_owners()->detach();
        $contact->contact_owners()->attach($valid['contact_owner_id']);

        // Activity Log
        //
        $log            = new ContactActivityLog();
        $log->entity_id = $contact->id;
        $log->note      = $updated[] = "Contact assigned to {$user->first_name} {$user->last_name}";
        $log->save();

        // Notification
        //
        try {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(2), NotificationSendType::find(2))) {
                foreach ($users_to_notify as $user_to_notify) {
                    Mail::to(User::find($user_to_notify))->send(new ContactUpdate($contact, $updated));
                }
            }

            $return  = [
                'message' => "{$contact->first_name} {$contact->last_name} was successfully assigned to {$user->first_name} {$user->last_name}",
                'valid'   => true,
            ];
        }
        catch (\Exception $exception) {
            Log::debug(__METHOD__ . ' - Exception - ' . $exception->getMessage());
        }

        return $return;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Contact  $contact
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $contact = new Contact;
        $contact = $contact->find($id);
        $contact->delete();
        $contact->locations()->delete();

        // Activity Log
        //
        $log            = new ContactActivityLog();
        $log->entity_id = $contact->id;
        $log->note      = 'Contact archived';
        $log->save();

        // Notification
        //
        try {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(3), NotificationSendType::find(2))) {
                foreach ($users_to_notify as $user_to_notify) {
                    Mail::to(User::find($user_to_notify))->send(new ContactDelete($contact));
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug(__METHOD__ . ' - Exception - ' . $exception->getMessage());
        }

        return redirect()->route('contacts.index');
    }
}
