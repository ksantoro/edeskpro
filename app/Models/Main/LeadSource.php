<?php

namespace App\Models\Main;

use App\Models\MainModel;
use App\Models\Tenant\Contact;
use Illuminate\Support\Facades\DB;

class LeadSource extends MainModel
{
    protected $connection = 'main';

    public function contacts()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(Contact::class, "{$database}.contact_lead_sources", 'lead_source_id', 'contact_id');
    }
}
