<?php

namespace App\Models\Tenant;

use App\Models\Main\EntityType;
use App\Models\TenantModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends TenantModel
{
    use SoftDeletes;

    protected
        $table    = 'activity_log',
        $fillable = [
            'entity_type_id',
            'entity_id',
            'note',
            'user_id',
            'created_at',
        ];

    public function scopeContacts($query)
    {
        return $query->where('entity_type_id', EntityType::CONTACT);
    }

    public function scopeContact($query, Contact $contact)
    {
        return $query->where('entity_type_id', EntityType::CONTACT)->where('entity_id', $contact->id);
    }

    public function scopeUsers($query)
    {
        return $query->where('entity_type_id', EntityType::USER);
    }
}
