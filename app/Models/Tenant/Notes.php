<?php

namespace App\Models\Tenant;

use App\Models\TenantModel;

class Notes extends TenantModel
{
    protected
        $fillable = [
            'id',
            'name',
            'description',
            'user_id',
            'created_at'
        ];
}
