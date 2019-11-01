<?php

namespace App\Models\Main;

use App\Models\MainModel;

class NotificationType extends MainModel
{
    public function action_type()
    {
        return $this->belongsTo(ActionType::class);
    }

    public function entity_type()
    {
        return $this->belongsTo(EntityType::class);
    }

    public function user_types()
    {
        return $this->belongsToMany(UserType::class, 'notification_type_user', 'notification_type_id', 'user_type_id');
    }
}
