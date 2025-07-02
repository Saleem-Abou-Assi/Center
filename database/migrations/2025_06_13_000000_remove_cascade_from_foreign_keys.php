<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DOCTORS TABLE
        Schema::table('doctors', function ($table) {
            DB::statement('ALTER TABLE doctors DROP FOREIGN KEY doctors_user_id_foreign');
            DB::statement('ALTER TABLE doctors DROP FOREIGN KEY doctors_dept_id_foreign');
        });
        Schema::table('doctors', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dept_id')->references('id')->on('departments');
        });

        // BOOKS TABLE
        Schema::table('books', function ($table) {
            DB::statement('ALTER TABLE books DROP FOREIGN KEY books_dept_id_foreign');
            DB::statement('ALTER TABLE books DROP FOREIGN KEY books_doctor_id_foreign');
        });
        Schema::table('books', function ($table) {
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        // PATIENT_FIELDS TABLE
        Schema::table('patient_fields', function ($table) {
            DB::statement('ALTER TABLE patient_fields DROP FOREIGN KEY patient_fields_patient_id_foreign');
            DB::statement('ALTER TABLE patient_fields DROP FOREIGN KEY patient_fields_field_id_foreign');
        });
        Schema::table('patient_fields', function ($table) {
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('field_id')->references('id')->on('fields');
        });

        // PERMISSION TABLES (model_has_permissions, model_has_roles, role_has_permissions)
        $permissionTables = config('permission.table_names');
        if ($permissionTables) {
            // model_has_permissions
            Schema::table($permissionTables['model_has_permissions'], function ($table) use ($permissionTables) {
                DB::statement('ALTER TABLE ' . $permissionTables['model_has_permissions'] . ' DROP FOREIGN KEY model_has_permissions_permission_id_foreign');
            });
            Schema::table($permissionTables['model_has_permissions'], function ($table) use ($permissionTables) {
                $table->foreign('permission_id')->references('id')->on($permissionTables['permissions']);
            });
            // model_has_roles
            Schema::table($permissionTables['model_has_roles'], function ($table) use ($permissionTables) {
                DB::statement('ALTER TABLE ' . $permissionTables['model_has_roles'] . ' DROP FOREIGN KEY model_has_roles_role_id_foreign');
            });
            Schema::table($permissionTables['model_has_roles'], function ($table) use ($permissionTables) {
                $table->foreign('role_id')->references('id')->on($permissionTables['roles']);
            });
            // role_has_permissions
            Schema::table($permissionTables['role_has_permissions'], function ($table) use ($permissionTables) {
                DB::statement('ALTER TABLE ' . $permissionTables['role_has_permissions'] . ' DROP FOREIGN KEY role_has_permissions_permission_id_foreign');
                DB::statement('ALTER TABLE ' . $permissionTables['role_has_permissions'] . ' DROP FOREIGN KEY role_has_permissions_role_id_foreign');
            });
            Schema::table($permissionTables['role_has_permissions'], function ($table) use ($permissionTables) {
                $table->foreign('permission_id')->references('id')->on($permissionTables['permissions']);
                $table->foreign('role_id')->references('id')->on($permissionTables['roles']);
            });
        }

        // ROLE_USER TABLE
        Schema::table('role_user', function ($table) {
            DB::statement('ALTER TABLE role_user DROP FOREIGN KEY role_user_role_id_foreign');
            DB::statement('ALTER TABLE role_user DROP FOREIGN KEY role_user_user_id_foreign');
        });
        Schema::table('role_user', function ($table) {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // APD_STORAGE TABLE
        Schema::table('apd_storage', function ($table) {
            DB::statement('ALTER TABLE apd_storage DROP FOREIGN KEY apd_storage_apd_id_foreign');
            DB::statement('ALTER TABLE apd_storage DROP FOREIGN KEY apd_storage_storage_id_foreign');
        });
        Schema::table('apd_storage', function ($table) {
            $table->foreign('apd_id')->references('id')->on('a_p_d_s');
            $table->foreign('storage_id')->references('id')->on('storages');
        });

        // WAITING_LISTS TABLE
        Schema::table('waiting_lists', function ($table) {
            DB::statement('ALTER TABLE waiting_lists DROP FOREIGN KEY waiting_lists_doctor_id_foreign');
            DB::statement('ALTER TABLE waiting_lists DROP FOREIGN KEY waiting_lists_patient_id_foreign');
        });
        Schema::table('waiting_lists', function ($table) {
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('patients');
        });

        // L_DETAILS TABLE
        Schema::table('l_details', function ($table) {
            DB::statement('ALTER TABLE l_details DROP FOREIGN KEY l_details_doctor_id_foreign');
        });
        Schema::table('l_details', function ($table) {
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        // LAZER_DETAILS TABLE
        Schema::table('lazer_details', function ($table) {
            DB::statement('ALTER TABLE lazer_details DROP FOREIGN KEY lazer_details_lazer_id_foreign');
            DB::statement('ALTER TABLE lazer_details DROP FOREIGN KEY lazer_details_l_details_id_foreign');
        });
        Schema::table('lazer_details', function ($table) {
            $table->foreign('lazer_id')->references('id')->on('lazers');
            $table->foreign('l_details_id')->references('id')->on('l_details');
        });

        // LAZERS TABLE
        Schema::table('lazers', function ($table) {
            DB::statement('ALTER TABLE lazers DROP FOREIGN KEY lazers_patient_id_foreign');
        });
        Schema::table('lazers', function ($table) {
            $table->foreign('patient_id')->references('id')->on('patients');
        });

        // SKINS TABLE
        Schema::table('skins', function ($table) {
            DB::statement('ALTER TABLE skins DROP FOREIGN KEY skins_patient_id_foreign');
            DB::statement('ALTER TABLE skins DROP FOREIGN KEY skins_doctor_id_foreign');
        });
        Schema::table('skins', function ($table) {
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        // ACCOUNTERS TABLE
        Schema::table('accounters', function ($table) {
            DB::statement('ALTER TABLE accounters DROP FOREIGN KEY accounters_patient_id_foreign');
        });
        Schema::table('accounters', function ($table) {
            $table->foreign('patient_id')->references('id')->on('patients');
        });

        // A_P_D_S TABLE
        Schema::table('a_p_d_s', function ($table) {
            DB::statement('ALTER TABLE a_p_d_s DROP FOREIGN KEY a_p_d_s_PD_id_foreign');
            DB::statement('ALTER TABLE a_p_d_s DROP FOREIGN KEY a_p_d_s_A_id_foreign');
            DB::statement('ALTER TABLE a_p_d_s DROP FOREIGN KEY a_p_d_s_doctor_id_foreign');
        });
        Schema::table('a_p_d_s', function ($table) {
            $table->foreign('PD_id')->references('id')->on('patient_depts');
            $table->foreign('A_id')->references('id')->on('accounters');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        // PATIENT_DEPTS TABLE
        Schema::table('patient_depts', function ($table) {
            DB::statement('ALTER TABLE patient_depts DROP FOREIGN KEY patient_depts_dept_id_foreign');
            DB::statement('ALTER TABLE patient_depts DROP FOREIGN KEY patient_depts_patient_id_foreign');
        });
        Schema::table('patient_depts', function ($table) {
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not implemented: would need to re-add cascade actions
    }
}; 