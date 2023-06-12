<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-nurse', [App\Http\Controllers\Nurse\DashboardController::class, 'index']);

Route::get('/nurse/action/checkup', [App\Http\Controllers\Nurse\CheckupController::class, 'index']);
Route::post('/nurse/action/checkup/{patient}/add', [App\Http\Controllers\Nurse\CheckupController::class, 'add']);
Route::post('/nurse/action/checkup/store/{patient}', [App\Http\Controllers\Nurse\CheckupController::class, 'store']);

Route::get('/nurse/report-checkup', [App\Http\Controllers\Nurse\ReportController::class, 'listCheckup']);
Route::get('/nurse/report-checkup/print', [App\Http\Controllers\Nurse\ReportController::class, 'printCheckup']);
Route::post('/nurse/report-checkup/code/print', [App\Http\Controllers\Nurse\ReportController::class, 'printCodeCheckup']);
Route::post('/nurse/report-checkup/date/print', [App\Http\Controllers\Nurse\ReportController::class, 'printDateCheckup']);
Route::post('/nurse/report-checkup/as/print', [App\Http\Controllers\Nurse\ReportController::class, 'printAsCheckup']);