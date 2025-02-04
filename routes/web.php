<?php

use App\Http\Controllers\AccounterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDeptController;
use App\Http\Controllers\LazerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorageController;
use App\Models\Accounter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WaitingListController;

//home page with no auth

Route::get('/notifications/count', [NotificationController::class, 'getNotificationCount']);

// groub the routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        return view('welcome');
    })->name('home');

    
//must be roll admin
Route::middleware(['role:admin'])->group(function () {
    // admin dashboard group
    Route::prefix('admin')->name('admin.')->group(function (){
        
    Route::get('/',[DashboardController::class,'index'])->name('');

    // In routes/web.php or routes/api.php
    

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::post('/reports/daily', [ReportController::class, 'generateDailyReport'])
    ->name('reports.daily');
Route::post('/reports/custom', [ReportController::class, 'generateCustomReport'])
    ->name('reports.custom');

    });

    Route::delete('/patients/{patient_id}', [PatientController::class, 'destroy'])->name('patient.destroy');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/doctors/{doctor_id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/doctors/{doctor_id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('/doctors/{doctor_id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/departments/{department_id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/departments/{department_id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/departments/{department_id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
    Route::get('/departments/{department_id}', [DepartmentController::class, 'show'])->name('department.show');



});

// ------doctor $ reciption-------
Route::group(['middleware' => ['role:doctor|admin|reciption']],function (){

    
    Route::get('/patients', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/patients/{patient_id}', [PatientController::class, 'show'])->name('patient.show');

    Route::get('/books', [BookController::class, 'index'])->name('book.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/books', [BookController::class, 'store'])->name('book.store');
    Route::get('/books/{book_id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/books/{book_id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{book_id}', [BookController::class, 'destroy'])->name('book.destroy');

    Route::get('/patientDept',[PatientDeptController::class,'index'])->name('patientDept.index');
    Route::post('/patientDept', [PatientDeptController::class, 'store'])->name('patientDept.store');

    Route::get('/lazer',[LazerController::class,'index'])->name('lazer.index');
    Route::post('/lazer', [LazerController::class, 'store'])->name('lazer.store');


    Route::get('/doctors/{doctor_id}', [DoctorController::class, 'show'])->name('doctor.show');

    Route::get('/waiting-list',[WaitingListController::class,'index'])->name('waitingList.index');
    Route::post('/waiting-list', [WaitingListController::class, 'store'])->name('waitingList.store');
    Route::delete('/waitlist/{id}', [WaitingListController::class, 'destroy'])->name('waitingList.destroy');
    
});


Route::middleware(['role:admin|reciption'])->group(function (){

// ------reciption-------

    Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/patients/{patient_id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
    Route::put('/patients/{patient_id}', [PatientController::class, 'update'])->name('patient.update');

    Route::get('/accounter/{apd_id}',[AccounterController::class,'index'])->name('accounter.index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});



Route::middleware(['role:admin|store'])->group(function (){

//-----store--------

Route::get('/storage', [StorageController::class, 'index'])->name('storage.index');
Route::get('/storage/create', [StorageController::class, 'create'])->name('storage.create');
Route::post('/storage', [StorageController::class, 'store'])->name('storage.store');
Route::get('/storage/{storage_id}', [StorageController::class, 'edit'])->name('storage.edit');
Route::put('/storage/{storage_id}', [StorageController::class, 'update'])->name('storage.update');
Route::delete('/storage/{storage_id}', [StorageController::class, 'destroy'])->name('storage.destroy');



});



});

Route::get('/reports/patient/{patientId}', [ReportController::class, 'generatePatientReport'])->name('reports.patient');
require __DIR__ . '/auth.php';
