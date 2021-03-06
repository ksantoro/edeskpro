<?php

use App\Models\Main\UserTypeRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TypeUserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTypeRole::query()->truncate();
        $items = [
            // God Mode User
            ['type_user_id' => 1, 'role_id' => 1,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 2,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 3,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 4,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 5,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 6,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 7,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 14, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 15, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 16, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 17, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 19, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 20, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 21, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 22, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 23, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 24, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 25, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 26, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 27, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 1, 'role_id' => 28, 'created_at' => Carbon::now()->toDateTimeString()],
            // Admin User
            ['type_user_id' => 2, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 14, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 15, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 16, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 17, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 19, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 20, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 21, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 22, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 23, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 24, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 25, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 26, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 27, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 2, 'role_id' => 28, 'created_at' => Carbon::now()->toDateTimeString()],
            // Technical
            ['type_user_id' => 3, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 14, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 15, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 16, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 17, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 19, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 20, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 21, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 22, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 23, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 24, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 25, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 26, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 27, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 3, 'role_id' => 28, 'created_at' => Carbon::now()->toDateTimeString()],
            // Customer Service Rep
            ['type_user_id' => 4, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 4, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 4, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 4, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 4, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 4, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            // Sales
            ['type_user_id' => 5, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 5, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 5, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 5, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 5, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 5, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            // Sales Manager
            ['type_user_id' => 6, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 14, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 15, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 16, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 17, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 19, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 20, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 21, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 22, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 23, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 24, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 25, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 26, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 27, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 6, 'role_id' => 28, 'created_at' => Carbon::now()->toDateTimeString()],
            // Field Tech
            ['type_user_id' => 7, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 7, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 7, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 7, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 7, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 7, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            // Foreman
            ['type_user_id' => 8, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 14, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 15, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 17, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 18, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 19, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 20, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 21, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 22, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 23, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 24, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 25, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 26, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 27, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 8, 'role_id' => 28, 'created_at' => Carbon::now()->toDateTimeString()],
            // Marketing
            ['type_user_id' => 9, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 9, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 9, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 9, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 9, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 9, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
            // Finance
            ['type_user_id' => 10, 'role_id' => 8,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 10, 'role_id' => 9,  'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 10, 'role_id' => 10, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 10, 'role_id' => 11, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 10, 'role_id' => 12, 'created_at' => Carbon::now()->toDateTimeString()],
            ['type_user_id' => 10, 'role_id' => 13, 'created_at' => Carbon::now()->toDateTimeString()],
        ];

        foreach ($items as $item) {
            UserTypeRole::updateOrCreate($item);
        }
    }
}
