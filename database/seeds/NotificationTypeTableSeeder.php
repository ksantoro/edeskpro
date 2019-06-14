<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NotificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_types')->insert([
            'id'             => 1,
            'entity_type_id' => 3, // Contact
            'action_type_id' => 1, // Create
            'description'    => 'New contact created in the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_types')->insert([
            'id'             => 2,
            'entity_type_id' => 3, // Contact
            'action_type_id' => 2, // Update
            'description'    => 'Contact was updated in the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_types')->insert([
            'id'             => 3,
            'entity_type_id' => 3, // Contact
            'action_type_id' => 3, // Deleted
            'description'    => 'Contact was deleted from the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_types')->insert([
            'id'             => 4,
            'entity_type_id' => 2, // User
            'action_type_id' => 1, // Create
            'description'    => 'New user created in the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_types')->insert([
            'id'             => 5,
            'entity_type_id' => 2, // User
            'action_type_id' => 2, // Update
            'description'    => 'User was updated in the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_types')->insert([
            'id'             => 6,
            'entity_type_id' => 2, // User
            'action_type_id' => 3, // Delete
            'description'    => 'User was delted from the system.',
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
    }
}
