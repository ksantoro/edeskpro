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
            'name'       => 'eDeskPro Company',
            'hostname'   => 'aa16q4o4htn12px.c3vly6qblre9.us-east-2.rds.amazonaws.com',
            'username'   => 'root',
            'password'   => encrypt('hza95ahr'),
            'database'   => 'edeskpro',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
