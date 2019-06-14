<?php

namespace App\Models\Main;

use App\Models\MainModel;

class EntityType extends MainModel
{
    public function notification_type()
    {
        return $this->hasOne(NotificationType::class);
    }
}
