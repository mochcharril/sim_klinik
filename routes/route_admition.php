<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-admition', [App\Http\Controllers\Admition\DashboardController::class, 'index']);

Route::get('/admition/master-data/patient', [App\Http\Controllers\Admition\PatientController::class, 'index']);
Route::get('/admition/master-data/patient/add', [App\Http\Controllers\Admition\PatientController::class, 'add']);
Route::post('/admition/master-data/patient/store', [App\Http\Controllers\Admition\PatientController::class, 'store']);
Route::post('/admition/master-data/patient/{patient}/edit', [App\Http\Controllers\Admition\PatientController::class, 'edit']);
Route::put('/admition/master-data/patient/update/{patient}', [App\Http\Controllers\Admition\PatientController::class, 'update']);
Route::delete('/admition/master-data/patient/{patient}/drop', [App\Http\Controllers\Admition\PatientController::class, 'drop']);
Route::post('/admition/master-data/patient/{patient}/print', [App\Http\Controllers\Admition\PatientController::class, 'print']);

Route::get('/admition/report-patient', [App\Http\Controllers\Admition\ReportController::class, 'listPatient']);
Route::get('/admition/report-patient/print', [App\Http\Controllers\Admition\ReportController::class, 'printPatient']);
Route::post('/admition/report-patient/as/print', [App\Http\Controllers\Admition\ReportController::class, 'printAsPatient']);