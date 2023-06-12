<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-clinic', [App\Http\Controllers\Clinic\DashboardController::class, 'index']);

Route::get('/clinic/report-medicine', [App\Http\Controllers\Clinic\ReportController::class, 'listMedicine']);
Route::get('/clinic/report-medicine/print', [App\Http\Controllers\Clinic\ReportController::class, 'printMedicine']);
Route::get('/clinic/report-incoming-medicine', [App\Http\Controllers\Clinic\ReportController::class, 'listMedicineIncoming']);
Route::get('/clinic/report-incoming-medicine/print', [App\Http\Controllers\Clinic\ReportController::class, 'printMedicineIncoming']);
Route::get('/clinic/report-checkup', [App\Http\Controllers\Clinic\ReportController::class, 'listCheckup']);
Route::get('/clinic/report-checkup/print', [App\Http\Controllers\Clinic\ReportController::class, 'printCheckup']);
Route::post('/clinic/report-checkup/code/print', [App\Http\Controllers\Clinic\ReportController::class, 'printCodeCheckup']);
Route::post('/clinic/report-checkup/date/print', [App\Http\Controllers\Clinic\ReportController::class, 'printDateCheckup']);
Route::post('/clinic/report-checkup/as/print', [App\Http\Controllers\Clinic\ReportController::class, 'printAsCheckup']);
Route::get('/clinic/report-patient', [App\Http\Controllers\Clinic\ReportController::class, 'listPatient']);
Route::get('/clinic/report-patient/print', [App\Http\Controllers\Clinic\ReportController::class, 'printPatient']);
Route::post('/clinic/report-patient/as/print', [App\Http\Controllers\Clinic\ReportController::class, 'printAsPatient']);
Route::get('/clinic/report-recipe', [App\Http\Controllers\Clinic\ReportController::class, 'listRecipe']);
Route::get('/clinic/report-recipe/print', [App\Http\Controllers\Clinic\ReportController::class, 'printRecipe']);
Route::post('/clinic/report-recipe/code/print', [App\Http\Controllers\Clinic\ReportController::class, 'printCodeRecipe']);
Route::post('/clinic/report-recipe/date/print', [App\Http\Controllers\Clinic\ReportController::class, 'printDateRecipe']);
Route::get('/clinic/report-payment', [App\Http\Controllers\Clinic\ReportController::class, 'listPayment']);
Route::get('/clinic/report-payment/print', [App\Http\Controllers\Clinic\ReportController::class, 'printPayment']);
Route::post('/clinic/report-payment/code/print', [App\Http\Controllers\Clinic\ReportController::class, 'printCodePayment']);
Route::post('/clinic/report-payment/date/print', [App\Http\Controllers\Clinic\ReportController::class, 'printDatePayment']);
Route::get('/clinic/report-top-sick', [App\Http\Controllers\Clinic\ReportController::class, 'listTopSick']);
Route::get('/clinic/report-top-sick/print', [App\Http\Controllers\Clinic\ReportController::class, 'printTopSick']);