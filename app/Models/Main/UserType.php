<?php

namespace App\Models\Main;

use App\Models\MainModel;

class UserType extends MainModel
{
    protected $table = 'type_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification_types()
    {
        return $this->belongsToMany(NotificationType::class, 'notification_type_user', 'user_type_id', 'notification_type_id');
    }
}
