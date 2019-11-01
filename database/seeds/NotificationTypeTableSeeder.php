<?php

use App\Models\Main\NotificationType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_types')->truncate();

        $items = [
            [
                'id'             => 1,
                'entity_type_id' => 3, // Contact
                'action_type_id' => 1, // Create
                'description'    => 'New contact created in the system.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 2,
                'entity_type_id' => 3, // Contact
                'action_type_id' => 2, // Update
                'description'    => 'Contact was updated in the system.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 3,
                'entity_type_id' => 3, // Contact
                'action_type_id' => 3, // Deleted
                'description'    => 'Contact was deleted from the system.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 4,
                'entity_type_id' => 2, // User
                'action_type_id' => 1, // Create
                'description'    => 'New user created in the system.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 5,
                'entity_type_id' => 2, // User
                'action_type_id' => 2, // Update
                'description'    => 'User was updated in the system.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 6,
                'entity_type_id' => 2, // User
                'action_type_id' => 3, // Delete
                'description'    => 'User was deleted from the system and archived.',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
            [
                'id'             => 7,
                'entity_type_id' => 3, // Contact
                'action_type_id' => 7, // Notify
                'description'    => 'Notify No Action Taken on Contact',
                'created_at'     => Carbon::now()->toDateTimeString()
            ],
        ];

        foreach ($items as $item) {
            NotificationType::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
