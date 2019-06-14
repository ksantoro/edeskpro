<?php

use Illuminate\Database\Seeder;

class NotificationTypeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 1, // Contact Create
            'user_type_id'         => 2, // Admin
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 1, // Contact Create
            'user_type_id'         => 4, // CSR
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 1, // Contact Create
            'user_type_id'         => 5, // Sales
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 1, // Contact Create
            'user_type_id'         => 6, // Sales Manager
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 2, // Contact Update
            'user_type_id'         => 2, // Admin
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 2, // Contact Update
            'user_type_id'         => 4, // CSR
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 2, // Contact Update
            'user_type_id'         => 5, // Sales
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 2, // Contact Update
            'user_type_id'         => 6, // Sales Manager
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 4, // User Create
            'user_type_id'         => 2, // Admin
        ]);
        DB::table('notification_type_user')->insert([
            'notification_type_id' => 5, // User Update
            'user_type_id'         => 2, // Admin
        ]);
    }
}
