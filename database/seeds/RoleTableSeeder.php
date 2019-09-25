<?php

use App\Models\Main\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->truncate();
        $items = [
            ['id' => 1, 'name' => 'Companies',             'entity_id' => '1', 'action_id' => '0', 'parent_id' => '0',  'is_configurable' => '0', 'is_internal' => '1', 'description' => 'Allows user access to companies.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 2, 'name' => 'Create Company',        'entity_id' => '1', 'action_id' => '1', 'parent_id' => '1',  'is_configurable' => '1', 'is_internal' => '1', 'description' => 'Allows user to create company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 3, 'name' => 'Save Company',          'entity_id' => '1', 'action_id' => '6', 'parent_id' => '1',  'is_configurable' => '0', 'is_internal' => '1', 'description' => 'Allows user to save company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 4, 'name' => 'View Company',          'entity_id' => '1', 'action_id' => '9', 'parent_id' => '1',  'is_configurable' => '1', 'is_internal' => '1', 'description' => 'Allows user to view company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 5, 'name' => 'Edit Company',          'entity_id' => '1', 'action_id' => '5', 'parent_id' => '1',  'is_configurable' => '1', 'is_internal' => '1', 'description' => 'Allows user to edit company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 6, 'name' => 'Update Company',        'entity_id' => '1', 'action_id' => '2', 'parent_id' => '1',  'is_configurable' => '0', 'is_internal' => '1', 'description' => 'Allows user to update company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 7, 'name' => 'Delete Company',        'entity_id' => '1', 'action_id' => '3', 'parent_id' => '1',  'is_configurable' => '1', 'is_internal' => '1', 'description' => 'Allows user to delete company.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 8, 'name' => 'Contacts',              'entity_id' => '3', 'action_id' => '0', 'parent_id' => '0',  'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user access to contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 9, 'name' => 'Create Contacts',       'entity_id' => '3', 'action_id' => '1', 'parent_id' => '8',  'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to create contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 10, 'name' => 'Save Contacts',        'entity_id' => '3', 'action_id' => '6', 'parent_id' => '8',  'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to save contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 11, 'name' => 'View Contacts',        'entity_id' => '3', 'action_id' => '9', 'parent_id' => '8',  'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to view contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 12, 'name' => 'Edit Contacts',        'entity_id' => '3', 'action_id' => '5', 'parent_id' => '8',  'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to edit contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 13, 'name' => 'Update Contacts',      'entity_id' => '3', 'action_id' => '2', 'parent_id' => '8',  'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to update contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 14, 'name' => 'Delete Contacts',      'entity_id' => '3', 'action_id' => '3', 'parent_id' => '8',  'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to delete contacts.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 15, 'name' => 'Users',                'entity_id' => '2', 'action_id' => '0', 'parent_id' => '0',  'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user access to users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 16, 'name' => 'Create Users',         'entity_id' => '2', 'action_id' => '1', 'parent_id' => '15', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to create users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 17, 'name' => 'Save Users',           'entity_id' => '2', 'action_id' => '6', 'parent_id' => '15', 'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to save users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 18, 'name' => 'View Users',           'entity_id' => '2', 'action_id' => '9', 'parent_id' => '15', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to view users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 19, 'name' => 'Edit Users',           'entity_id' => '2', 'action_id' => '5', 'parent_id' => '15', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to edit users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 20, 'name' => 'Update Users',         'entity_id' => '2', 'action_id' => '2', 'parent_id' => '15', 'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to update users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 21, 'name' => 'Delete Users',         'entity_id' => '2', 'action_id' => '3', 'parent_id' => '15', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to delete users.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 22, 'name' => 'Notifications',        'entity_id' => '4', 'action_id' => '0', 'parent_id' => '0',  'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user access to notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 23, 'name' => 'Create Notifications', 'entity_id' => '4', 'action_id' => '1', 'parent_id' => '22', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to create notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 24, 'name' => 'Save Notifications',   'entity_id' => '4', 'action_id' => '6', 'parent_id' => '22', 'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to save notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 25, 'name' => 'View Notifications',   'entity_id' => '4', 'action_id' => '9', 'parent_id' => '22', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to view notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 26, 'name' => 'Edit Notifications',   'entity_id' => '4', 'action_id' => '5', 'parent_id' => '22', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to edit notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 27, 'name' => 'Update Notifications', 'entity_id' => '4', 'action_id' => '2', 'parent_id' => '22', 'is_configurable' => '0', 'is_internal' => '0', 'description' => 'Allows user to update notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
            ['id' => 28, 'name' => 'Delete Notifications', 'entity_id' => '4', 'action_id' => '3', 'parent_id' => '22', 'is_configurable' => '1', 'is_internal' => '0', 'description' => 'Allows user to delete notifications.', 'created_at' => Carbon::now()->toDateTimeString()],
        ];

        foreach ($items as $item) {
            Role::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
