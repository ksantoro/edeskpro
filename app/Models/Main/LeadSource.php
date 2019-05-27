<?php

namespace App\Models\Main;

use App\Models\MainModel;

class LeadSource extends MainModel
{
    protected $connection = 'main';

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
