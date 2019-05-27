<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TypeUserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 4,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 5,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 2,
            'role_id'      => 6,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Technical
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 4,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 5,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 3,
            'role_id'      => 6,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Customer Service
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 4,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 4,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 4,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Sales Person
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 5,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 5,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 5,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Sales Manager
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 4,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 5,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 6,
            'role_id'      => 6,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Field Technician
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 7,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 7,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 7,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Foreman
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 4,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 5,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 8,
            'role_id'      => 6,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Marketing
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 9,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 9,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 9,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);

        // Finance
        //
        DB::table('type_user_roles')->insert([
            'type_user_id' => 10,
            'role_id'      => 1,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 10,
            'role_id'      => 2,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user_roles')->insert([
            'type_user_id' => 10,
            'role_id'      => 3,
            'created_at'   => Carbon::now()->toDateTimeString()
        ]);
    }
}
