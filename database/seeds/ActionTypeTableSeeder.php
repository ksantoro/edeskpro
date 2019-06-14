<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('action_types')->insert([
            'id'          => 1,
            'name'        => 'Create',
            'description' => 'Create a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('action_types')->insert([
            'id'          => 2,
            'name'        => 'Update',
            'description' => 'Update a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('action_types')->insert([
            'id'          => 3,
            'name'        => 'Delete',
            'description' => 'Delete a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('action_types')->insert([
            'id'          => 4,
            'name'        => 'Archive',
            'description' => 'Archive a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('action_types')->insert([
            'id'          => 5,
            'name'        => 'Edit',
            'description' => 'Edit a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('action_types')->insert([
            'id'          => 6,
            'name'        => 'Store',
            'description' => 'Store a new entity',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
    }
}
