<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_types')->insert([
            'name'       => 'Lead',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contact_types')->insert([
            'name'       => 'Opportunity',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contact_types')->insert([
            'name'       => 'Customer',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
