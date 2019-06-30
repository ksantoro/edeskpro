<?php

namespace App\Models\Tenant;

use App\Models\TenantModel;

class Notes extends TenantModel
{
    protected
        $fillable = [
            'entity_type_id',
            'entity_id',
            'note',
            'user_id',
            'created_at',
        ];

    public function scopeForContact($query)
    {
        return $query->where('entity_type_id', EntityType::CONTACT);
    }

    public function scopeForUser($query)
    {
        return $query->where('entity_type_id', EntityType::USER);
    }

    public function contact_notes()
    {
        return $this->belongsToMany(Contact::class, 'notes', 'entity_id');
    }
}
