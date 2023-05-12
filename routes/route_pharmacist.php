<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-pharmacist', [App\Http\Controllers\Pharmacist\DashboardController::class, 'index']);

Route::get('/pharmacist/master-data/medicine', [App\Http\Controllers\Pharmacist\MedicineController::class, 'index']);
Route::get('/pharmacist/master-data/medicine/add', [App\Http\Controllers\Pharmacist\MedicineController::class, 'add']);
Route::post('/pharmacist/master-data/medicine/store', [App\Http\Controllers\Pharmacist\MedicineController::class, 'store']);
Route::post('/pharmacist/master-data/medicine/{medicine}/edit', [App\Http\Controllers\Pharmacist\MedicineController::class, 'edit']);
Route::put('/pharmacist/master-data/medicine/update/{medicine}', [App\Http\Controllers\Pharmacist\MedicineController::class, 'update']);
Route::delete('/pharmacist/master-data/medicine/{medicine}/drop', [App\Http\Controllers\Pharmacist\MedicineController::class, 'drop']);

Route::get('/pharmacist/master-data/medicine_rule', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'index']);
Route::get('/pharmacist/master-data/medicine_rule/add', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'add']);
Route::post('/pharmacist/master-data/medicine_rule/store', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'store']);
Route::post('/pharmacist/master-data/medicine_rule/{medicine_rule}/edit', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'edit']);
Route::put('/pharmacist/master-data/medicine_rule/update/{medicine_rule}', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'update']);
Route::delete('/pharmacist/master-data/medicine_rule/{medicine_rule}/drop', [App\Http\Controllers\Pharmacist\MedicineRuleController::class, 'drop']);

Route::get('/pharmacist/warehouse/incoming_medicine', [App\Http\Controllers\Pharmacist\IncomingMedicineController::class, 'index']);
Route::get('/pharmacist/warehouse/incoming_medicine/add', [App\Http\Controllers\Pharmacist\IncomingMedicineController::class, 'add']);
Route::post('/pharmacist/warehouse/incoming_medicine/store', [App\Http\Controllers\Pharmacist\IncomingMedicineController::class, 'store']);
Route::post('/pharmacist/warehouse/incoming_medicine/{incoming_medicine}/detail', [App\Http\Controllers\Pharmacist\IncomingMedicineController::class, 'detail']);

Route::get('/pharmacist/payment', [App\Http\Controllers\Pharmacist\PaymentController::class, 'index']);
Route::post('/pharmacist/payment/{checkup}/add', [App\Http\Controllers\Pharmacist\PaymentController::class, 'add']);
Route::post('/pharmacist/payment/store/{checkup}', [App\Http\Controllers\Pharmacist\PaymentController::class, 'store']);
Route::post('/pharmacist/payment/{checkup}/detail', [App\Http\Controllers\Pharmacist\PaymentController::class, 'detail']);
Route::post('/pharmacist/payment/{checkup}/print', [App\Http\Controllers\Pharmacist\PaymentController::class, 'print']);
Route::post('/pharmacist/payment/{checkup}/print_nota', [App\Http\Controllers\Pharmacist\PaymentController::class, 'printNota']);

Route::get('/pharmacist/report-medicine', [App\Http\Controllers\Pharmacist\ReportController::class, 'listMedicine']);
Route::get('/pharmacist/report-medicine/print', [App\Http\Controllers\Pharmacist\ReportController::class, 'printMedicine']);
Route::get('/pharmacist/report-incoming-medicine', [App\Http\Controllers\Pharmacist\ReportController::class, 'listMedicineIncoming']);
Route::get('/pharmacist/report-incoming-medicine/print', [App\Http\Controllers\Pharmacist\ReportController::class, 'printMedicineIncoming']);