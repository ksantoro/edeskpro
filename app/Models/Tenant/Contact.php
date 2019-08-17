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

    public function noActionTaken()
    {
        $noAction = [];
        Log::debug(__METHOD__. ' Begin contact search...');

        try {
            $contacts = Contact::with('activityLog')->where('created_at', '>', Carbon::now()->subHours(1)->toDateTimeString())->get();

            if (count($contacts) > 0) {
                Log::debug(__METHOD__ . ' -- Contacts Found Created in the last hour --');
                foreach ($contacts as $contact) {
                    Log::debug(__METHOD__ . " - Contact: {$contact->first_name} {$contact->last_name}");
                    if (count(ActivityLog::contact($contact)->get()) <= 1) {
                        Log::debug(__METHOD__ . " -- Contacts Found Created in the last hour with NO ACTIVITY --");
                        $noAction[] = $contact;
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
