<?php

namespace App\Models\Main;

use App\Models\MainModel;

class ContactType extends MainModel
{
    protected
        $fillable = ['id', 'name'];

    public function contacts()
    {
        return $this->hasMany('App\Models\Tenant\Contact');
    }
}
