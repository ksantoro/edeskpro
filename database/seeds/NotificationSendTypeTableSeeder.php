<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NotificationSendTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_send_types')->insert([
            'name'        => 'System',
            'description' => 'General System Notification',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_send_types')->insert([
            'name'        => 'Email',
            'description' => 'Email Notification',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_send_types')->insert([
            'name'        => 'SMS',
            'description' => 'SMS Text Notification',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('notification_send_types')->insert([
            'name'        => 'Push',
            'description' => 'Push Notification',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
