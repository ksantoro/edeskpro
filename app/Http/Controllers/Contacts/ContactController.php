<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Mail\ContactCreate;
use App\Models\Tenant\ActivityLog;
use App\Models\Tenant\Contact;
use App\Models\Main\ContactMethodType;
use App\Models\Main\ContactType;
use App\Models\Main\EntityType;
use App\Models\Tenant\Location;
use App\Models\Main\NotificationSendType;
use App\Models\Main\NotificationType;
use App\Models\Tenant\NotificationUser;
use App\Models\Main\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $contacts = Contact::all();

        return view('contacts.index')
            ->with('contacts', $contacts)
            ->with('counts', $this->contact_counts());
    }

    public function search(Request $request)
    {
        $contacts = Contact::where('first_name', 'LIKE', "%{$request->search_term}%")
            ->orWhere('last_name', 'LIKE', "%{$request->search_term}%")
            ->orWhere('phone', 'LIKE', "%{$request->search_term}%")
            ->orWhere('email', 'LIKE', "%{$request->search_term}%")
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
        $contacts = Contact::whereNotNull('deleted_at');
        return view('contacts.index')->with('contacts', $contacts)->with('counts', $this->contact_counts());
    }

    public function create()
    {
        return view('contacts.create', [
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_types'        => ContactType::all()
        ]);
    }

    public function store(Request $request)
    {
        Log::debug($request);
        $request->merge(array_map('trim', $request->all()));

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'title'                 => 'nullable|max:255',
            'contact_owner_id'      => 'nullable|numeric|max:25',
            'contact_type_id'       => 'required|numeric|max:25',
            'email'                 => 'required|email|unique:tenant.contacts',
            'email_type_id'         => 'required|numeric|max:25',
            'phone'                 => 'required|numeric|regex:/[0-9]{10}/',
            'phone_type_id'         => 'required|numeric|max:25',
            'billing_address_type'  => 'required|numeric|max:25',
            'billing_street'        => 'required|max:255',
            'billing_suite'         => 'nullable|max:255',
            'billing_city'          => 'required|max:255',
            'billing_state'         => 'required|max:255',
            'billing_zip'           => 'required|max:255',
            'delivery_address_type' => 'required|numeric|max:25',
            'delivery_street'       => 'required|max:255',
            'delivery_suite'        => 'nullable|max:255',
            'delivery_city'         => 'required|max:255',
            'delivery_state'        => 'required|max:255',
            'delivery_zip'          => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/contacts/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Contact Basic Info
        //
        $contact                  = new Contact;
        $contact->contact_type_id = $request->contact_type_id;
        $contact->first_name      = $request->first_name;
        $contact->last_name       = $request->last_name;
        $contact->title           = $request->title;
        $contact->email           = $request->email;
        $contact->email_type_id   = $request->email_type_id;
        $contact->phone           = $request->phone;
        $contact->phone_type_id   = $request->phone_type_id;
        $contact->save();

        // Contact Owner
        //
        if ($request->contact_owner_id) {
           $contact->contact_owners()->attach($request->contact_owner_id);
        }

        // Contact Billing Info
        //
        $billing = new Location;
        $billing->contact_id             = $contact->id;
        $billing->is_billing             = 1;
        $billing->contact_method_type_id = $request->billing_address_type;
        $billing->street                 = $request->billing_street;
        $billing->suite                  = $request->billing_suite;
        $billing->city                   = $request->billing_city;
        $billing->state                  = $request->billing_state;
        $billing->zip                    = $request->billing_zip;
        $billing->save();

        // Contact Delivery Info
        //
        $delivery                         = new Location;
        $delivery->contact_id             = $contact->id;
        $delivery->is_billing             = 0;
        $delivery->contact_method_type_id = $request->delivery_address_type;
        $delivery->street                 = $request->delivery_street;
        $delivery->suite                  = $request->delivery_suite;
        $delivery->city                   = $request->delivery_city;
        $delivery->state                  = $request->delivery_state;
        $delivery->zip                    = $request->delivery_zip;
        $delivery->save();

        // Send Notifications
        //
        if ($request->contact_owner_id) {
            Mail::to(User::find($request->contact_owner_id))->send(new ContactCreate($contact));
        }

        try
        {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(1), NotificationSendType::find(2))) {
                foreach ($users_to_notify as $user_to_notify)
                {
                    Mail::to(User::find($user_to_notify))->send(new ContactCreate($contact));
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug($exception);
        }

        // Activity Log
        //
        $log                 = new ActivityLog();
        $log->entity_type_id = EntityType::CONTACT;
        $log->entity_id      = $contact->id;
        $log->note           = 'Contact created in the system';
        $log->user_id        = Auth::user()->id;
        $log->created_at     = Carbon::now();
        $log->save();

        return redirect()->route('contacts.show', [$contact->id]);
    }

    public function show($id)
    {
        $activity = [];
        $contact  = new Contact;
        $contact  = $contact->find($id);

        if ($log = ActivityLog::contact($contact)->orderBy('created_at', 'desc')->get()) {
            foreach ($log as $item) {
                $user       = User::find($item->user_id)->first();
                $activity[] = [
                    'note' => $item->note,
                    'ts'   => $item->created_at,
                    'user' => "{$user->first_name} {$user->last_name}",
                ];
            }
        }

        return view('contacts.show', [
            'contact'              => $contact,
            'contact_owner'        => $contact->contact_owners()->first(),
            'contact_type'         => ContactType::find($contact->contact_type_id),
            'billing'              => Contact::find($contact->id)->locations()->where('is_billing', 1)->first(),
            'delivery'             => Contact::find($contact->id)->locations()->where('is_billing', 0)->first(),
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_types'        => ContactType::all(),
            'activity'             => $activity,
        ]);
    }

    public function edit($id)
    {
        $contact = new Contact;
        $contact = $contact->find($id);

        return view('contacts.edit', [
            'contact'              => $contact,
            'contact_owner'        => $contact->contact_owners()->first(),
            'billing'              => Contact::find($contact->id)->locations()->where('is_billing', 1)->first(),
            'delivery'             => Contact::find($contact->id)->locations()->where('is_billing', 0)->first(),
            'contact_method_types' => ContactMethodType::all(),
            'contact_owners'       => User::AllUsers()->get(),
            'contact_types'        => ContactType::all()
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Contact  $contact
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        Log::debug($request);
        $request->merge(array_map('trim', $request->all()));

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'title'                 => 'nullable|max:255',
            'contact_owner_id'      => 'nullable|numeric|max:25',
            'contact_type_id'       => 'required|numeric|max:25',
            'email'                 => 'required|email|max:255',
            'email_type_id'         => 'required|numeric|max:25',
            'phone'                 => 'required|numeric|regex:/[0-9]{10}/',
            'phone_type_id'         => 'required|numeric|max:25',
            'billing_address_type'  => 'required|numeric|max:25',
            'billing_street'        => 'required|max:255',
            'billing_suite'         => 'nullable|max:255',
            'billing_city'          => 'required|max:255',
            'billing_state'         => 'required|max:255',
            'billing_zip'           => 'required|max:255',
            'delivery_address_type' => 'required|numeric|max:25',
            'delivery_street'       => 'required|max:255',
            'delivery_suite'        => 'nullable|max:255',
            'delivery_city'         => 'required|max:255',
            'delivery_state'        => 'required|max:255',
            'delivery_zip'          => 'required|max:255',
        ]);

        if ($validator->fails()) {
           return redirect("/contacts/{$id}/edit")
               ->withErrors($validator)
               ->withInput();
        }

        // Contact Basic Info
        //
        $contact                  = Contact::find($id);
        $contact_old              = $contact;
        $contact->contact_type_id = $request->contact_type_id;
        $contact->first_name      = $request->first_name;
        $contact->last_name       = $request->last_name;
        $contact->title           = $request->title;
        $contact->email           = $request->email;
        $contact->email_type_id   = $request->email_type_id;
        $contact->phone           = $request->phone;
        $contact->phone_type_id   = $request->phone_type_id;
        $contact->save();

        // Contact Owner
        //
        if ($request->contact_owner_id) {
           $contact->contact_owners()->detach();
           $contact->contact_owners()->attach($request->contact_owner_id);
        }

        // Contact Billing Info
        //
        $billing                         = Location::find($contact->id)->where('is_billing', 1)->first();
        $billing->contact_id             = $contact->id;
        $billing->is_billing             = 1;
        $billing->contact_method_type_id = $request->billing_address_type;
        $billing->street                 = $request->billing_street;
        $billing->suite                  = $request->billing_suite;
        $billing->city                   = $request->billing_city;
        $billing->state                  = $request->billing_state;
        $billing->zip                    = $request->billing_zip;
        $billing->save();

        // Contact Delivery Info
        //
        $delivery                         = Location::find($contact->id)->where('is_billing', 0)->first();
        $delivery->contact_id             = $contact->id;
        $delivery->is_billing             = 0;
        $delivery->contact_method_type_id = $request->delivery_address_type;
        $delivery->street                 = $request->delivery_street;
        $delivery->suite                  = $request->delivery_suite;
        $delivery->city                   = $request->delivery_city;
        $delivery->state                  = $request->delivery_state;
        $delivery->zip                    = $request->delivery_zip;
        $delivery->save();

        // Activity Log
        //
        $log                 = new ActivityLog();
        $log->entity_type_id = EntityType::CONTACT;
        $log->entity_id      = $contact->id;
        $log->note           = 'Contact updated in the system';
        $log->user_id        = Auth::user()->id;
        $log->created_at     = Carbon::now();
        $log->save();

       return redirect()->route('contacts.show', [$contact->id]);
    }

    public function assign(Request $request)
    {
        $contact = Contact::find($request->contact_id);
        $user    = User::find($request->contact_owner_id);
        $contact->contact_owners()->detach();
        $contact->contact_owners()->attach($request->contact_owner_id);

        // Activity Log
        //
        $log                 = new ActivityLog();
        $log->entity_type_id = EntityType::CONTACT;
        $log->entity_id      = $contact->id;
        $log->note           = "Contact assigned to {$user->first_name} {$user->last_name}";
        $log->user_id        = Auth::user()->id;
        $log->created_at     = Carbon::now();
        $log->save();

        return redirect()->route('contacts.show', [$contact->id]);
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
        $log                 = new ActivityLog();
        $log->entity_type_id = EntityType::CONTACT;
        $log->entity_id      = $contact->id;
        $log->note           = 'Contact archived';
        $log->user_id        = Auth::user()->id;
        $log->created_at     = Carbon::now();
        $log->save();

        return redirect()->route('contacts.index');
    }
}
