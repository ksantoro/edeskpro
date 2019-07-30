<?php

namespace App\Models\Tenant;

use App\Models\Main\ContactType;
use App\Models\Main\EntityType;
use App\Models\Main\LeadSource;
use App\Models\Main\User;
use App\Models\TenantModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public function scopeNoActionTaken($query)
    {
        return $query->leftJoin('activity_log', function ($join) {
                $join->on('activity_log.entity_id', '=', 'contacts.id')
                    ->where('activity_log.entity_type_id', '=', EntityType::CONTACT);
            })
            ->where('contacts.created_at', '>', 'DATE_SUB(NOW(), INTERVAL 1 HOUR)')
            ->where('contacts.deleted_at', '!=', 'null')
            ->where('activity_log.id', '=', 'null');
    }
}
