<?php

namespace App\Models\Tenant;

use App\Models\TenantPivot;

class ContactNotes extends TenantPivot
{
    protected
        $fillable = ['contact_id', 'note_id'];

    public function contacts()
    {
        return $this->belongsTo('App\Models\Tenant\Contact');
    }

    public function notes()
    {
        return $this->belongsTo('App\Models\Tenant\Notes');
    }
}
