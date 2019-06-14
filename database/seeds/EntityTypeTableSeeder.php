<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EntityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_types')->insert([
            'id'          => 1,
            'name'        => 'Company',
            'description' => 'Companies',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('entity_types')->insert([
            'id'          => 2,
            'name'        => 'User',
            'description' => 'Users',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('entity_types')->insert([
            'id'          => 3,
            'name'        => 'Contact',
            'description' => 'Contacts',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('entity_types')->insert([
            'id'          => 4,
            'name'        => 'Notification',
            'description' => 'Notifications',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
    }
}
