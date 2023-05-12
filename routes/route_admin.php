<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin/master-data/poly', [App\Http\Controllers\Admin\PolyController::class, 'index']);
Route::get('/admin/master-data/poly/add', [App\Http\Controllers\Admin\PolyController::class, 'add']);
Route::post('/admin/master-data/poly/store', [App\Http\Controllers\Admin\PolyController::class, 'store']);
Route::post('/admin/master-data/poly/{poly}/edit', [App\Http\Controllers\Admin\PolyController::class, 'edit']);
Route::put('/admin/master-data/poly/update/{poly}', [App\Http\Controllers\Admin\PolyController::class, 'update']);
Route::delete('/admin/master-data/poly/{poly}/drop', [App\Http\Controllers\Admin\PolyController::class, 'drop']);
Route::get('/admin/master-data/poly/detail-poly-general', [App\Http\Controllers\Admin\PolyController::class, 'detailGeneral']);
Route::get('/admin/master-data/poly/detail-poly-teeth', [App\Http\Controllers\Admin\PolyController::class, 'detailTeeth']);
Route::get('/admin/master-data/poly/detail-poly-kia', [App\Http\Controllers\Admin\PolyController::class, 'detailKia']);

Route::get('/admin/payment', [App\Http\Controllers\Admin\PaymentController::class, 'index']);
Route::post('/admin/payment/{checkup}/add', [App\Http\Controllers\Admin\PaymentController::class, 'add']);
Route::post('/admin/payment/store/{checkup}', [App\Http\Controllers\Admin\PaymentController::class, 'store']);
Route::post('/admin/payment/{checkup}/detail', [App\Http\Controllers\Admin\PaymentController::class, 'detail']);
Route::post('/admin/payment/{checkup}/print', [App\Http\Controllers\Admin\PaymentController::class, 'print']);
Route::post('/admin/payment/{checkup}/print_nota', [App\Http\Controllers\Admin\PaymentController::class, 'printNota']);

Route::get('/admin/report-patient', [App\Http\Controllers\Admin\ReportController::class, 'listPatient']);
Route::get('/admin/report-patient/print', [App\Http\Controllers\Admin\ReportController::class, 'printPatient']);
Route::get('/admin/report-medicine', [App\Http\Controllers\Admin\ReportController::class, 'listMedicine']);
Route::get('/admin/report-medicine/print', [App\Http\Controllers\Admin\ReportController::class, 'printMedicine']);
Route::get('/admin/report-incoming-medicine', [App\Http\Controllers\Admin\ReportController::class, 'listMedicineIncoming']);
Route::get('/admin/report-incoming-medicine/print', [App\Http\Controllers\Admin\ReportController::class, 'printMedicineIncoming']);
Route::post('/admin/report-incoming-medicine/code/print', [App\Http\Controllers\Admin\ReportController::class, 'printCodeMedicineIncoming']);
Route::post('/admin/report-incoming-medicine/date/print', [App\Http\Controllers\Admin\ReportController::class, 'printDateMedicineIncoming']);
Route::get('/admin/report-checkup', [App\Http\Controllers\Admin\ReportController::class, 'listCheckup']);
Route::get('/admin/report-checkup/print', [App\Http\Controllers\Admin\ReportController::class, 'printCheckup']);
Route::post('/admin/report-checkup/code/print', [App\Http\Controllers\Admin\ReportController::class, 'printCodeCheckup']);
Route::post('/admin/report-checkup/date/print', [App\Http\Controllers\Admin\ReportController::class, 'printDateCheckup']);
Route::get('/admin/report-recipe', [App\Http\Controllers\Admin\ReportController::class, 'listRecipe']);
Route::get('/admin/report-recipe/print', [App\Http\Controllers\Admin\ReportController::class, 'printRecipe']);
Route::post('/admin/report-recipe/code/print', [App\Http\Controllers\Admin\ReportController::class, 'printCodeRecipe']);
Route::post('/admin/report-recipe/date/print', [App\Http\Controllers\Admin\ReportController::class, 'printDateRecipe']);
Route::get('/admin/report-payment', [App\Http\Controllers\Admin\ReportController::class, 'listPayment']);
Route::get('/admin/report-payment/print', [App\Http\Controllers\Admin\ReportController::class, 'printPayment']);
Route::post('/admin/report-payment/code/print', [App\Http\Controllers\Admin\ReportController::class, 'printCodePayment']);
Route::post('/admin/report-payment/date/print', [App\Http\Controllers\Admin\ReportController::class, 'printDatePayment']);