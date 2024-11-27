<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        Permission::create(['name' => 'show-all-patients']);
        Permission::create(['name' => 'show-patient']);
        Permission::create(['name' => 'create-patient']);
        Permission::create(['name' => 'update-patient']);
        Permission::create(['name' => 'delete-patients']);

        Permission::create(['name' => 'show-all-patients']);
        Permission::create(['name' => 'show-patient']);
        Permission::create(['name' => 'create-patient']);
        Permission::create(['name' => 'update-patient']);
        Permission::create(['name' => 'delete-patients']);


        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');


    }
}
