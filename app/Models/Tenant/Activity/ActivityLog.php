<?php

namespace App\Models\Tenant\Activity;

use App\Models\Tenant\Contact;
use App\Models\Main\EntityType;
use App\Models\TenantModel;

class ActivityLog extends TenantModel
{
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
