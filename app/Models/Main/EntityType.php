<?php

namespace App\Models\Main;

use App\Models\MainModel;

class EntityType extends MainModel
{
    const
        COMPANY      = 1,
        USER         = 2,
        CONTACT      = 3,
        NOTIFICATION = 4;

    public function notification_type()
    {
        return $this->hasOne(NotificationType::class);
    }
}
