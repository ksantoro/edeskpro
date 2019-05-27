<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'             => 1,
            'company_id'     => 1,
            'first_name'     => 'Kimi',
            'last_name'      => 'HBIC',
            'email'          => 'info@soulwebdesign.com',
            'type_user_id'   => 1,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id'             => 2,
            'company_id'     => 1,
            'first_name'     => 'James',
            'last_name'      => 'Jolly',
            'email'          => 'jjolly@yoststucco.com',
            'type_user_id'   => 2,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id'             => 3,
            'company_id'     => 1,
            'first_name'     => 'Carol',
            'last_name'      => 'Ranck',
            'email'          => 'cranck@yoststucco.com',
            'type_user_id'   => 4,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id'             => 4,
            'company_id'     => 1,
            'first_name'     => 'Bill',
            'last_name'      => 'Mullen',
            'email'          => 'bmullen@yoststucco.com',
            'type_user_id'   => 3,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id'             => 5,
            'company_id'     => 2,
            'first_name'     => 'Kimi',
            'last_name'      => 'Testing2',
            'email'          => 'kimi@test2.com',
            'type_user_id'   => 1,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id'             => 6,
            'company_id'     => 2,
            'first_name'     => 'Somebody',
            'last_name'      => 'Else',
            'email'          => 'somebody@else.com',
            'type_user_id'   => 2,
            'password'       => bcrypt('hza95ahr'),
            'remember_token' => 1,
            'created_at'     => Carbon::now()->toDateTimeString()
        ]);
    }
}
