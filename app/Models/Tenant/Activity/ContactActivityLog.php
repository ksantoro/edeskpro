<?php

namespace App\Models\Tenant\Activity;

use App\Models\Main\EntityType;
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
}
