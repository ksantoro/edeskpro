<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Main\ActionType;

class ActionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id'          => 1,
                'name'        => 'Create',
                'description' => 'Create a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 2,
                'name'        => 'Update',
                'description' => 'Update a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 3,
                'name'        => 'Delete',
                'description' => 'Delete a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 4,
                'name'        => 'Archive',
                'description' => 'Archive a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 5,
                'name'        => 'Edit',
                'description' => 'Edit a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 6,
                'name'        => 'Store',
                'description' => 'Store a new entity',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 7,
                'name'        => 'Notify',
                'description' => 'Notification',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
            [
                'id'          => 8,
                'name'        => 'Reminder',
                'description' => 'Remind Notification',
                'created_at'  => Carbon::now()->toDateTimeString()
            ],
        ];

        foreach ($items as $item) {
            ActionType::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
