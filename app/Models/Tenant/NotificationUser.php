<?php

namespace App\Models\Tenant;

use App\Models\TenantModel;
use App\Models\Main\NotificationSendType;
use App\Models\Main\NotificationType;

class NotificationUser extends TenantModel
{
    public function find_users_to_notify(NotificationType $notification_type, NotificationSendType $notification_send_type)
    {
        $notify = [];
        $users  = NotificationUser::where('notification_type_id', $notification_type->id)
                    ->where('notification_send_type_id', $notification_send_type->id)
                    ->get();

        foreach ($users as $user)
        {
            $notify[] = $user->user_id;
        }

        return $notify;
    }
}
