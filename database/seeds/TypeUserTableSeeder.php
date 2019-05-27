<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TypeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_user')->insert([
            'id'          => 1,
            'name'        => 'god',
            'description' => 'God Mode (Superuser)',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 2,
            'name'        => 'admin',
            'description' => 'Administrator',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 3,
            'name'        => 'technical',
            'description' => 'Technical',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 4,
            'name'        => 'csr',
            'description' => 'Customer Service',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 5,
            'name'        => 'sales',
            'description' => 'Salesperson',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 6,
            'name'        => 'sales_manager',
            'description' => 'Sales Manager',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 7,
            'name'        => 'field_tech',
            'description' => 'Field Technician',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 8,
            'name'        => 'foreman',
            'description' => 'Foreman',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 9,
            'name'        => 'marketing',
            'description' => 'Marketing',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
        DB::table('type_user')->insert([
            'id'          => 10,
            'name'        => 'finance',
            'description' => 'Finance',
            'created_at'  => Carbon::now()->toDateTimeString()
        ]);
    }
}
