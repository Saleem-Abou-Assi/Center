<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = Role::create(['name' => 'doctor']);
        $reciption = Role::create(['name'=>'reciption']);
        $store = Role::create(['name'=>'store']);

        //doctor permissions
        $doctor->givePermissionTo('show-all-patients');
        $doctor->givePermissionTo('show-patient');
        $doctor->givePermissionTo('show-book');
        $doctor->givePermissionTo('show-all-books');
        $doctor->givePermissionTo('create-book');
        $doctor->givePermissionTo('update-book');
        $doctor->givePermissionTo('show-home');
        $doctor->givePermissionTo('create-patientDept');
        $doctor->givePermissionTo('create-lazer');

        //reciption permissions
        $reciption->givePermissionTo('show-all-patients');
        $reciption->givePermissionTo('show-patient');
        $reciption->givePermissionTo('create-patient');
        $reciption->givePermissionTo('update-patient');
        $reciption->givePermissionTo('delete-book');
        $reciption->givePermissionTo('show-book');
        $reciption->givePermissionTo('show-all-books');
        $reciption->givePermissionTo('create-book');
        $reciption->givePermissionTo('update-book');    
        $reciption->givePermissionTo('show-home');
        $reciption->givePermissionTo('account');

        //store permissions
        $store->givePermissionTo('show-all-storages');
        $store->givePermissionTo('show-storage');
        $store->givePermissionTo('create-storage');
        $store->givePermissionTo('update-storage');
        $store->givePermissionTo('delete-storages');

    }
}
