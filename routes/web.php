<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return redirect('/login');});
Route::get('/redirect', [RedirectController::class, 'index']);

/* admin */
Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

Route::get('/admin/master-data/patient', [App\Http\Controllers\Admin\PatientController::class, 'index']);
Route::get('/admin/master-data/patient/add', [App\Http\Controllers\Admin\PatientController::class, 'add']);
Route::post('/admin/master-data/patient/store', [App\Http\Controllers\Admin\PatientController::class, 'store']);
Route::post('/admin/master-data/patient/{patient}/edit', [App\Http\Controllers\Admin\PatientController::class, 'edit']);
Route::put('/admin/master-data/patient/update/{patient}', [App\Http\Controllers\Admin\PatientController::class, 'update']);
Route::delete('/admin/master-data/patient/{patient}/drop', [App\Http\Controllers\Admin\PatientController::class, 'drop']);
Route::post('/admin/master-data/patient/{patient}/print', [App\Http\Controllers\Admin\PatientController::class, 'print']);

Route::get('/admin/master-data/doctor', [App\Http\Controllers\Admin\DoctorController::class, 'index']);
Route::get('/admin/master-data/doctor/add', [App\Http\Controllers\Admin\DoctorController::class, 'add']);
Route::post('/admin/master-data/doctor/store', [App\Http\Controllers\Admin\DoctorController::class, 'store']);
Route::post('/admin/master-data/doctor/{user}/edit', [App\Http\Controllers\Admin\DoctorController::class, 'edit']);
Route::put('/admin/master-data/doctor/update/{user}', [App\Http\Controllers\Admin\DoctorController::class, 'update']);
Route::delete('/admin/master-data/doctor/{user}/drop', [App\Http\Controllers\Admin\DoctorController::class, 'drop']);

Route::get('/admin/master-data/nurse', [App\Http\Controllers\Admin\NurseController::class, 'index']);
Route::get('/admin/master-data/nurse/add', [App\Http\Controllers\Admin\NurseController::class, 'add']);
Route::post('/admin/master-data/nurse/store', [App\Http\Controllers\Admin\NurseController::class, 'store']);
Route::post('/admin/master-data/nurse/{user}/edit', [App\Http\Controllers\Admin\NurseController::class, 'edit']);
Route::put('/admin/master-data/nurse/update/{user}', [App\Http\Controllers\Admin\NurseController::class, 'update']);
Route::delete('/admin/master-data/nurse/{user}/drop', [App\Http\Controllers\Admin\NurseController::class, 'drop']);

Route::get('/admin/master-data/pharmacist', [App\Http\Controllers\Admin\PharmacistController::class, 'index']);
Route::get('/admin/master-data/pharmacist/add', [App\Http\Controllers\Admin\PharmacistController::class, 'add']);
Route::post('/admin/master-data/pharmacist/store', [App\Http\Controllers\Admin\PharmacistController::class, 'store']);
Route::post('/admin/master-data/pharmacist/{user}/edit', [App\Http\Controllers\Admin\PharmacistController::class, 'edit']);
Route::put('/admin/master-data/pharmacist/update/{user}', [App\Http\Controllers\Admin\PharmacistController::class, 'update']);
Route::delete('/admin/master-data/pharmacist/{user}/drop', [App\Http\Controllers\Admin\PharmacistController::class, 'drop']);

Route::get('/admin/master-data/admition', [App\Http\Controllers\Admin\AdmitionController::class, 'index']);
Route::get('/admin/master-data/admition/add', [App\Http\Controllers\Admin\AdmitionController::class, 'add']);
Route::post('/admin/master-data/admition/store', [App\Http\Controllers\Admin\AdmitionController::class, 'store']);
Route::post('/admin/master-data/admition/{user}/edit', [App\Http\Controllers\Admin\AdmitionController::class, 'edit']);
Route::put('/admin/master-data/admition/update/{user}', [App\Http\Controllers\Admin\AdmitionController::class, 'update']);
Route::delete('/admin/master-data/admition/{user}/drop', [App\Http\Controllers\Admin\AdmitionController::class, 'drop']);

Route::get('/admin/master-data/clinic', [App\Http\Controllers\Admin\ClinicController::class, 'index']);
Route::get('/admin/master-data/clinic/add', [App\Http\Controllers\Admin\ClinicController::class, 'add']);
Route::post('/admin/master-data/clinic/store', [App\Http\Controllers\Admin\ClinicController::class, 'store']);
Route::post('/admin/master-data/clinic/{user}/edit', [App\Http\Controllers\Admin\ClinicController::class, 'edit']);
Route::put('/admin/master-data/clinic/update/{user}', [App\Http\Controllers\Admin\ClinicController::class, 'update']);
Route::delete('/admin/master-data/clinic/{user}/drop', [App\Http\Controllers\Admin\ClinicController::class, 'drop']);

require __DIR__.'/auth.php';
