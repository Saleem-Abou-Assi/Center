<?php

use App\Http\Controllers\AccounterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDeptController;
use App\Models\Accounter;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/patients', [PatientController::class, 'index'])->name('patient.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patient.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patients/{patient_id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
Route::put('/patients/{patient_id}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patients/{patient_id}', [PatientController::class, 'destroy'])->name('patient.destroy');
Route::get('/patients/{patient_id}', [PatientController::class, 'show'])->name('patient.show');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.index');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctor.create');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('/doctors/{doctor_id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/doctors/{doctor_id}', [DoctorController::class, 'update'])->name('doctor.update');
Route::delete('/doctors/{doctor_id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
Route::get('/doctors/{doctor_id}', [DoctorController::class, 'show'])->name('doctor.show');

Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/departments', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departments/{department_id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/departments/{department_id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/departments/{department_id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
Route::get('/departments/{department_id}', [DepartmentController::class, 'show'])->name('department.show');

Route::get('/patientDept',[PatientDeptController::class,'index'])->name('patientDept.index');
Route::post('/patientDept', [PatientDeptController::class, 'store'])->name('patientDept.store');

Route::get('/accounter/{apd_id}',[AccounterController::class,'index'])->name('accounter.index');

