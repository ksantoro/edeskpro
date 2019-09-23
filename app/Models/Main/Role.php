<?php

namespace App\Models\Main;

use App\Models\MainModel;
use Illuminate\Support\Facades\DB;

class Role extends MainModel
{
    protected $connection = 'main';

    public function users()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(User::class, "{$database}.user_roles", 'role_id', 'user_id');
    }

    public function scopeConfigurable($query)
    {
        return $query->where('is_configurable', 1)->where('is_internal', 0);
    }

    public function scopeParent($query)
    {
        return $query->where('parent_id', 0)->where('is_internal', 0);
    }
}
