<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LeadSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_sources')->insert([
            'id'          => 1,
            'name'        => 'Search Engine',
            'description' => 'Google',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 2,
            'name'        => 'Search Engine',
            'description' => 'Bing',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 3,
            'name'        => 'Search Engine',
            'description' => 'Other',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 4,
            'name'        => 'Social Media',
            'description' => 'Facebook',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 5,
            'name'        => 'Social Media',
            'description' => 'Twitter',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 6,
            'name'        => 'Social Media',
            'description' => 'LinkedIn',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 7,
            'name'        => 'Social Media',
            'description' => 'YouTube',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 8,
            'name'        => 'Social Media',
            'description' => 'Other',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 9,
            'name'        => 'Referral Site',
            'description' => 'Home Advisor',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 10,
            'name'        => 'Referral Site',
            'description' => 'Yellow Pages',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 11,
            'name'        => 'Referral Site',
            'description' => 'Yelp',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 12,
            'name'        => 'Referral Site',
            'description' => 'Angies List',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 13,
            'name'        => 'Referral Site',
            'description' => 'Other',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 14,
            'name'        => 'Word of Mouth',
            'description' => 'Family/Friend/Neighbor',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 15,
            'name'        => 'Word of Mouth',
            'description' => 'Agent/Professional',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 16,
            'name'        => 'Email',
            'description' => 'Email Marketing',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 17,
            'name'        => 'Print',
            'description' => 'Direct Mail Advertising',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 18,
            'name'        => 'Print',
            'description' => 'Postcard',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 19,
            'name'        => 'Industry',
            'description' => 'Expo/Seminar',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 20,
            'name'        => 'Industry',
            'description' => 'Trade Show',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('lead_sources')->insert([
            'id'          => 21,
            'name'        => 'Website',
            'description' => 'Direct',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
    }
}
