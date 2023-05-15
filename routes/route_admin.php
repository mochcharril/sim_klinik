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

Route::get('/admin/master-data/admin', [App\Http\Controllers\Admin\AdminController::class, 'index']);
Route::get('/admin/master-data/admin/add', [App\Http\Controllers\Admin\AdminController::class, 'add']);
Route::post('/admin/master-data/admin/store', [App\Http\Controllers\Admin\AdminController::class, 'store']);
Route::post('/admin/master-data/admin/{user}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit']);
Route::put('/admin/master-data/admin/update/{user}', [App\Http\Controllers\Admin\AdminController::class, 'update']);
Route::delete('/admin/master-data/admin/{user}/drop', [App\Http\Controllers\Admin\AdminController::class, 'drop']);

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
Route::get('/admin/report-top-sick', [App\Http\Controllers\Admin\ReportController::class, 'listTopSick']);
Route::get('/admin/report-top-sick/print', [App\Http\Controllers\Admin\ReportController::class, 'printTopSick']);

Route::get('/admin/master-data/medicine', [App\Http\Controllers\Admin\MedicineController::class, 'index']);
Route::get('/admin/master-data/medicine/add', [App\Http\Controllers\Admin\MedicineController::class, 'add']);
Route::post('/admin/master-data/medicine/store', [App\Http\Controllers\Admin\MedicineController::class, 'store']);
Route::post('/admin/master-data/medicine/{medicine}/edit', [App\Http\Controllers\Admin\MedicineController::class, 'edit']);
Route::put('/admin/master-data/medicine/update/{medicine}', [App\Http\Controllers\Admin\MedicineController::class, 'update']);
Route::delete('/admin/master-data/medicine/{medicine}/drop', [App\Http\Controllers\Admin\MedicineController::class, 'drop']);

Route::get('/admin/warehouse/incoming_medicine', [App\Http\Controllers\Admin\IncomingMedicineController::class, 'index']);
Route::get('/admin/warehouse/incoming_medicine/add', [App\Http\Controllers\Admin\IncomingMedicineController::class, 'add']);
Route::post('/admin/warehouse/incoming_medicine/store', [App\Http\Controllers\Admin\IncomingMedicineController::class, 'store']);
Route::post('/admin/warehouse/incoming_medicine/{incoming_medicine}/detail', [App\Http\Controllers\Admin\IncomingMedicineController::class, 'detail']);

Route::get('/admin/master-data/medicine_rule', [App\Http\Controllers\Admin\MedicineRuleController::class, 'index']);
Route::get('/admin/master-data/medicine_rule/add', [App\Http\Controllers\Admin\MedicineRuleController::class, 'add']);
Route::post('/admin/master-data/medicine_rule/store', [App\Http\Controllers\Admin\MedicineRuleController::class, 'store']);
Route::post('/admin/master-data/medicine_rule/{medicine_rule}/edit', [App\Http\Controllers\Admin\MedicineRuleController::class, 'edit']);
Route::put('/admin/master-data/medicine_rule/update/{medicine_rule}', [App\Http\Controllers\Admin\MedicineRuleController::class, 'update']);
Route::delete('/admin/master-data/medicine_rule/{medicine_rule}/drop', [App\Http\Controllers\Admin\MedicineRuleController::class, 'drop']);

Route::get('/admin/master-data/measure', [App\Http\Controllers\Admin\MeasureController::class, 'index']);
Route::get('/admin/master-data/measure/add', [App\Http\Controllers\Admin\MeasureController::class, 'add']);
Route::post('/admin/master-data/measure/store', [App\Http\Controllers\Admin\MeasureController::class, 'store']);
Route::post('/admin/master-data/measure/{measure}/edit', [App\Http\Controllers\Admin\MeasureController::class, 'edit']);
Route::put('/admin/master-data/measure/update/{measure}', [App\Http\Controllers\Admin\MeasureController::class, 'update']);
Route::delete('/admin/master-data/measure/{measure}/drop', [App\Http\Controllers\Admin\MeasureController::class, 'drop']);

Route::get('/admin/action/checkup', [App\Http\Controllers\Admin\CheckupController::class, 'index']);
Route::post('/admin/action/checkup/{patient}/add', [App\Http\Controllers\Admin\CheckupController::class, 'add']);
Route::post('/admin/action/checkup-nurse/{checkup}/add', [App\Http\Controllers\Admin\CheckupController::class, 'addNurse']);
Route::post('/admin/action/checkup/store/{patient}', [App\Http\Controllers\Admin\CheckupController::class, 'store']);
Route::post('/admin/action/checkup/store-nurse/{checkup}', [App\Http\Controllers\Admin\CheckupController::class, 'storeNurse']);

Route::get('/admin/action/recipe', [App\Http\Controllers\Admin\RecipeController::class, 'index']);
Route::post('/admin/action/recipe/{checkup}/add', [App\Http\Controllers\Admin\RecipeController::class, 'add']);
Route::post('/admin/action/recipe/store/{checkup}', [App\Http\Controllers\Admin\RecipeController::class, 'store']);
Route::post('/admin/action/recipe/{checkup}/detail', [App\Http\Controllers\Admin\RecipeController::class, 'detail']);

Route::get('/admin/medical-reports', [App\Http\Controllers\Admin\MedicalReportController::class, 'index']);
Route::post('/admin/medical-reports/{patient}/detail', [App\Http\Controllers\Admin\MedicalReportController::class, 'detail']);
Route::post('/admin/medical-reports/{patient}/print', [App\Http\Controllers\Admin\MedicalReportController::class, 'print']);

Route::get('/admin/medical-resume', [App\Http\Controllers\Admin\MedicalResumeReportController::class, 'index']);
Route::get('/admin/medical-resume/{checkup}/print', [App\Http\Controllers\Admin\MedicalResumeReportController::class, 'printResume']);
Route::get('/admin/medical-resume/{checkup}/detail', [App\Http\Controllers\Admin\MedicalResumeReportController::class, 'detail']);
Route::post('/admin/medical-resume/{checkup}/detail/send', [App\Http\Controllers\Admin\MedicalResumeReportController::class, 'store']);

Route::get('/admin/informed-consent', [App\Http\Controllers\Admin\InformedConsentController::class, 'index']);
Route::get('/admin/informed-consent/agreement-form/{checkup}', [App\Http\Controllers\Admin\InformedConsentController::class, 'agreementForm']);
Route::get('/admin/informed-consent/rejection-form/{checkup}', [App\Http\Controllers\Admin\InformedConsentController::class, 'rejectionForm']);

Route::get('/admin/medical', [App\Http\Controllers\Admin\MedicalController::class, 'index']);