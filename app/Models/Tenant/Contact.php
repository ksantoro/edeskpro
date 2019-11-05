<?php

namespace App\Models\Tenant;

use App\Models\Main\ContactType;
use App\Models\Main\LeadSource;
use App\Models\Main\User;
use App\Models\Tenant\Activity\ActivityLog;
use App\Models\Tenant\Activity\ContactActivityLog;
use App\Models\TenantModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Contact extends TenantModel
{
    use SoftDeletes;

    const
        TYPE_LEAD     = 1,
        TYPE_OPP      = 2,
        TYPE_CUSTOMER = 3;

    protected
        $fillable = [
            'contact_type_id',
            'first_name',
            'last_name',
            'title',
            'phone',
            'phone_type_id',
            'email',
            'email_type_id',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

    public function activityLog()
    {
        return $this->hasMany(ContactActivityLog::class, 'entity_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function contact_owners()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(User::class, "{$database}.contact_owners", 'contact_id', 'user_id');
    }

    public function contact_types()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function lead_source()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(LeadSource::class, "{$database}.contact_lead_sources", 'contact_id', 'lead_source_id');
    }

    public function scopeMyContacts($query)
    {
        return $query->join('contact_owners', 'contacts.id', '=', 'contact_owners.contact_id')->where('contact_owners.user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc');
    }

    public function scopeLeads($query)
    {
        return $query->where('contact_type_id', self::TYPE_LEAD);
    }

    public function scopeOpportunities($query)
    {
        return $query->where('contact_type_id', self::TYPE_OPP);
    }

    public function scopeCustomers($query)
    {
        return $query->where('contact_type_id', self::TYPE_CUSTOMER);
    }

    public function scopeLastHour($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subHours(1)->toDateTimeString());
    }

    public function scopeLast24Hours($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subDay()->toDateTimeString());
    }

    public function noActionTaken()
    {
        $noAction = [];

        try {
            $contacts = Contact::Last24Hours()->get();

            if (count($contacts) > 0) {
                foreach ($contacts as $contact) {
                    if (count(ActivityLog::contact($contact)->get()) <= 1) {
                        if (count(Notes::contact($contact)->get()) <= 1) {
                            $noAction[] = $contact;
                        }
                    }
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug(__METHOD__ . ' - Exception - ' . $exception->getMessage());
        }

        return $noAction;
    }
}
