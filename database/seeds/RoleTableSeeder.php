<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'          => 1,
            'name'        => 'Create Contact',
            'object'      => 'contact',
            'action'      => 'create',
            'description' => 'Allows user to create contacts.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('roles')->insert([
            'id'          => 2,
            'name'        => 'Update Contact',
            'object'      => 'contact',
            'action'      => 'update',
            'description' => 'Allows user to update contacts.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('roles')->insert([
            'id'          => 3,
            'name'        => 'Delete Contact',
            'object'      => 'contact',
            'action'      => 'delete',
            'description' => 'Allows user to delete contacts.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('roles')->insert([
            'id'          => 4,
            'name'        => 'Create User',
            'object'      => 'user',
            'action'      => 'create',
            'description' => 'Allows user to create users.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('roles')->insert([
            'id'          => 5,
            'name'        => 'Update User',
            'object'      => 'user',
            'action'      => 'update',
            'description' => 'Allows user to update users.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('roles')->insert([
            'id'          => 6,
            'name'        => 'Delete User',
            'object'      => 'user',
            'action'      => 'delete',
            'description' => 'Allows user to delete users.',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
    }
}
