<?php

namespace App\Models\Tenant\Activity;

use App\Models\Main\EntityType;
use App\Models\Tenant\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ContactActivityLog extends ActivityLog
{
    function __construct()
    {
        parent::__construct([
            'created_at'     => Carbon::now(),
            'entity_type_id' => EntityType::CONTACT,
            'user_id'        => Auth::user()->id,
        ]);
    }

    public function contacts()
    {
        return $this->belongsTo(Contact::class, 'entity_id', 'id')->where('entity_type_id', EntityType::CONTACT);
    }
}
