<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'id'         => 1,
            'name'       => 'Test Company',
            'hostname'   => 'localhost',
            'username'   => 'root',
            'password'   => encrypt('hza95ahr'),
            'database'   => 'test_db',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('companies')->insert([
            'id'         => 2,
            'name'       => 'Test Company 2',
            'hostname'   => 'localhost',
            'username'   => 'root',
            'password'   => encrypt('hza95ahr'),
            'database'   => 'test_db2',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
