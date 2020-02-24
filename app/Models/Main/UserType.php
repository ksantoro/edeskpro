<?php

namespace App\Models\Main;

use App\Models\MainModel;

class UserType extends MainModel
{
    const
        TYPE_USER_GOD        = 1,
        TYPE_USER_ADMIN      = 2,
        TYPE_USER_TECH       = 3,
        TYPE_USER_CSR        = 4,
        TYPE_USER_SALES      = 5,
        TYPE_USER_SALES_MGR  = 6,
        TYPE_USER_FIELD_TECH = 7,
        TYPE_USER_FOREMAN    = 8,
        TYPE_USER_MARKETING  = 9,
        TYPE_USER_FINANCE    = 10;

    protected
        $table = 'type_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification_types()
    {
        return $this->belongsToMany(NotificationType::class, 'notification_type_user', 'user_type_id', 'notification_type_id');
    }

    public function scopeAllTypes($query)
    {
        return $query->where('id', '<>', 1);
    }
}
