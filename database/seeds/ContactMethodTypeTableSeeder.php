<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactMethodTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_method_types')->insert([
            'name'       => 'Home',
            'icon_class' => 'fas fa-home',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contact_method_types')->insert([
            'name'       => 'Work',
            'icon_class' => 'fas fa-building',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('contact_method_types')->insert([
            'name'       => 'Mobile',
            'icon_class' => 'fas fa-mobile-alt',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
