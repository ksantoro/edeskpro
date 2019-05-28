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
    }
}
