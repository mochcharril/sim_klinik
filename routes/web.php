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
Route::get('/getMedicine/{medicine}', [RedirectController::class, 'getMedicine']);
Route::get('/getReportCheckup/{patient}', [RedirectController::class, 'getReportCheckup']);
Route::get('/getReportCheckupDate/{start_date}/{end_date}', [RedirectController::class, 'getReportCheckupDate']);

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

Route::get('/admin/master-data/poly', [App\Http\Controllers\Admin\PolyController::class, 'index']);
Route::get('/admin/master-data/poly/add', [App\Http\Controllers\Admin\PolyController::class, 'add']);
Route::post('/admin/master-data/poly/store', [App\Http\Controllers\Admin\PolyController::class, 'store']);
Route::post('/admin/master-data/poly/{poly}/edit', [App\Http\Controllers\Admin\PolyController::class, 'edit']);
Route::put('/admin/master-data/poly/update/{poly}', [App\Http\Controllers\Admin\PolyController::class, 'update']);
Route::delete('/admin/master-data/poly/{poly}/drop', [App\Http\Controllers\Admin\PolyController::class, 'drop']);

Route::get('/admin/payment', [App\Http\Controllers\Admin\PaymentController::class, 'index']);
Route::post('/admin/payment/{checkup}/add', [App\Http\Controllers\Admin\PaymentController::class, 'add']);
Route::post('/admin/payment/store/{checkup}', [App\Http\Controllers\Admin\PaymentController::class, 'store']);
Route::post('/admin/payment/{checkup}/detail', [App\Http\Controllers\Admin\PaymentController::class, 'detail']);
Route::post('/admin/payment/{checkup}/print', [App\Http\Controllers\Admin\PaymentController::class, 'print']);

Route::get('/admin/report-patient', [App\Http\Controllers\Admin\ReportController::class, 'listPatient']);
Route::get('/admin/report-patient/print', [App\Http\Controllers\Admin\ReportController::class, 'printPatient']);
Route::get('/admin/report-medicine', [App\Http\Controllers\Admin\ReportController::class, 'listMedicine']);
Route::get('/admin/report-medicine/print', [App\Http\Controllers\Admin\ReportController::class, 'printMedicine']);
Route::get('/admin/report-incoming-medicine', [App\Http\Controllers\Admin\ReportController::class, 'listMedicineIncoming']);
Route::get('/admin/report-incoming-medicine/print', [App\Http\Controllers\Admin\ReportController::class, 'printMedicineIncoming']);
Route::get('/admin/report-checkup', [App\Http\Controllers\Admin\ReportController::class, 'listCheckup']);
Route::get('/admin/report-checkup/print', [App\Http\Controllers\Admin\ReportController::class, 'printCheckup']);
Route::post('/admin/report-checkup/code/print', [App\Http\Controllers\Admin\ReportController::class, 'printCodeCheckup']);
Route::post('/admin/report-checkup/date/print', [App\Http\Controllers\Admin\ReportController::class, 'printDateCheckup']);

/* admition */
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

/* pharmacist */
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

Route::get('/pharmacist/report-medicine', [App\Http\Controllers\Pharmacist\ReportController::class, 'listMedicine']);
Route::get('/pharmacist/report-medicine/print', [App\Http\Controllers\Pharmacist\ReportController::class, 'printMedicine']);
Route::get('/pharmacist/report-incoming-medicine', [App\Http\Controllers\Pharmacist\ReportController::class, 'listMedicineIncoming']);
Route::get('/pharmacist/report-incoming-medicine/print', [App\Http\Controllers\Pharmacist\ReportController::class, 'printMedicineIncoming']);

/* clinic */
Route::get('/dashboard-clinic', [App\Http\Controllers\Clinic\DashboardController::class, 'index']);

Route::get('/clinic/report-medicine', [App\Http\Controllers\Clinic\ReportController::class, 'listMedicine']);
Route::get('/clinic/report-medicine/print', [App\Http\Controllers\Clinic\ReportController::class, 'printMedicine']);
Route::get('/clinic/report-incoming-medicine', [App\Http\Controllers\Clinic\ReportController::class, 'listMedicineIncoming']);
Route::get('/clinic/report-incoming-medicine/print', [App\Http\Controllers\Clinic\ReportController::class, 'printMedicineIncoming']);

/* doctor */
Route::get('/dashboard-doctor', [App\Http\Controllers\Doctor\DashboardController::class, 'index']);

Route::get('/doctor/master-data/medicine_rule', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'index']);
Route::get('/doctor/master-data/medicine_rule/add', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'add']);
Route::post('/doctor/master-data/medicine_rule/store', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'store']);
Route::post('/doctor/master-data/medicine_rule/{medicine_rule}/edit', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'edit']);
Route::put('/doctor/master-data/medicine_rule/update/{medicine_rule}', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'update']);
Route::delete('/doctor/master-data/medicine_rule/{medicine_rule}/drop', [App\Http\Controllers\Doctor\MedicineRuleController::class, 'drop']);

Route::get('/doctor/master-data/measure', [App\Http\Controllers\Doctor\MeasureController::class, 'index']);
Route::get('/doctor/master-data/measure/add', [App\Http\Controllers\Doctor\MeasureController::class, 'add']);
Route::post('/doctor/master-data/measure/store', [App\Http\Controllers\Doctor\MeasureController::class, 'store']);
Route::post('/doctor/master-data/measure/{measure}/edit', [App\Http\Controllers\Doctor\MeasureController::class, 'edit']);
Route::put('/doctor/master-data/measure/update/{measure}', [App\Http\Controllers\Doctor\MeasureController::class, 'update']);
Route::delete('/doctor/master-data/measure/{measure}/drop', [App\Http\Controllers\Doctor\MeasureController::class, 'drop']);

Route::get('/doctor/action/checkup', [App\Http\Controllers\Doctor\CheckupController::class, 'index']);
Route::post('/doctor/action/checkup/{patient}/add', [App\Http\Controllers\Doctor\CheckupController::class, 'add']);
Route::post('/doctor/action/checkup/store/{patient}', [App\Http\Controllers\Doctor\CheckupController::class, 'store']);

Route::get('/doctor/action/recipe', [App\Http\Controllers\Doctor\RecipeController::class, 'index']);
Route::post('/doctor/action/recipe/{checkup}/add', [App\Http\Controllers\Doctor\RecipeController::class, 'add']);
Route::post('/doctor/action/recipe/store/{checkup}', [App\Http\Controllers\Doctor\RecipeController::class, 'store']);
Route::post('/doctor/action/recipe/{checkup}/detail', [App\Http\Controllers\Doctor\RecipeController::class, 'detail']);

Route::get('/doctor/medical-reports', [App\Http\Controllers\Doctor\MedicalReportController::class, 'index']);
Route::post('/doctor/medical-reports/{patient}/detail', [App\Http\Controllers\Doctor\MedicalReportController::class, 'detail']);
Route::post('/doctor/medical-reports/{patient}/print', [App\Http\Controllers\Doctor\MedicalReportController::class, 'print']);

/* nurse */
Route::get('/dashboard-nurse', [App\Http\Controllers\Nurse\DashboardController::class, 'index']);

Route::get('/nurse/action/checkup', [App\Http\Controllers\Nurse\CheckupController::class, 'index']);
Route::post('/nurse/action/checkup/{patient}/add', [App\Http\Controllers\Nurse\CheckupController::class, 'add']);
Route::post('/nurse/action/checkup/store/{patient}', [App\Http\Controllers\Nurse\CheckupController::class, 'store']);

require __DIR__.'/auth.php';
