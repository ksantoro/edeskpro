<?php

use Illuminate\Database\Seeder;
use App\Models\Main\NotificationTypeUser;

class NotificationTypeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_type_user')->truncate();

        $items = [
            [
                'notification_type_id' => 1, // Contact Create
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 1, // Contact Create
                'user_type_id'         => 4, // CSR
            ],
            [
                'notification_type_id' => 1, // Contact Create
                'user_type_id'         => 5, // Sales
            ],
            [
                'notification_type_id' => 1, // Contact Create
                'user_type_id'         => 6, // Sales Manager
            ],
            [
                'notification_type_id' => 2, // Contact Update
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 2, // Contact Update
                'user_type_id'         => 4, // CSR
            ],
            [
                'notification_type_id' => 2, // Contact Update
                'user_type_id'         => 5, // Sales
            ],
            [
                'notification_type_id' => 2, // Contact Update
                'user_type_id'         => 6, // Sales Manager
            ],
            [
                'notification_type_id' => 3, // Contact Deleted
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 3, // Contact Deleted
                'user_type_id'         => 6, // Sales Manager
            ],

            [
                'notification_type_id' => 7, // Contact No Action
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 7, // Contact No Action
                'user_type_id'         => 6, // Sales Manager
            ],
            [
                'notification_type_id' => 4, // User Create
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 5, // User Update
                'user_type_id'         => 2, // Admin
            ],
            [
                'notification_type_id' => 6, // User Delete
                'user_type_id'         => 2, // Admin
            ],
        ];

        foreach ($items as $item) {
            $ntu = new NotificationTypeUser;
            $ntu->notification_type_id = $item['notification_type_id'];
            $ntu->user_type_id         = $item['user_type_id'];
            $ntu->save();
        }
    }
}
