<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompaniesTableSeeder::class,
            ContactMethodTypeTableSeeder::class,
            ContactTypeTableSeeder::class,
            TypeUserTableSeeder::class,
            LeadSourcesTableSeeder::class,
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            TypeUserRoleTableSeeder::class,
        ]);
    }
}
