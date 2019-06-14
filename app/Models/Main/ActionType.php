<?php

namespace App\Models\Main;

use App\Models\MainModel;

class ActionType extends MainModel
{
    public function notification_type()
    {
        return $this->hasOne(NotificationType::class);
    }
}
