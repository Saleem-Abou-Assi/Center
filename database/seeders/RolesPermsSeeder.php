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

        //patients
        Permission::create(['name' => 'show-all-patients']);
        Permission::create(['name' => 'show-patient']);
        Permission::create(['name' => 'create-patient']);
        Permission::create(['name' => 'update-patient']);
        Permission::create(['name' => 'delete-patients']);

        //book
        Permission::create(['name' => 'show-all-books']);
        Permission::create(['name' => 'show-book']);
        Permission::create(['name' => 'create-book']);
        Permission::create(['name' => 'update-book']);
        Permission::create(['name' => 'delete-book']);

        // doctors
        Permission::create(['name' => 'show-all-doctors']);
        Permission::create(['name' => 'show-doctor']);
        Permission::create(['name' => 'create-doctor']);
        Permission::create(['name' => 'update-doctor']);
        Permission::create(['name' => 'delete-doctor']);

        //depts
        Permission::create(['name' => 'show-all-depts']);
        Permission::create(['name' => 'show-dept']);
        Permission::create(['name' => 'create-dept']);
        Permission::create(['name' => 'update-dept']);
        Permission::create(['name' => 'delete-dept']);

        //random
        Permission::create(['name' => 'show-home']);
        Permission::create(['name' => 'create-patientDept']);
        Permission::create(['name' => 'create-lazer']);
        Permission::create(['name' => 'account']);

        //storage Items
        Permission::create(['name' => 'show-all-storages']);
        Permission::create(['name' => 'show-storage']);
        Permission::create(['name' => 'create-storage']);
        Permission::create(['name' => 'update-storage']);
        Permission::create(['name' => 'delete-storages']);

        //later add the admin dashboared perms


        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password'=>'12345678'
        ]);
        $user->assignRole($admin);

    }
}
