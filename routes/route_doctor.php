<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/doctor/action/checkup-nurse/{checkup}/add', [App\Http\Controllers\Doctor\CheckupController::class, 'addNurse']);
Route::post('/doctor/action/checkup/store/{patient}', [App\Http\Controllers\Doctor\CheckupController::class, 'store']);
Route::post('/doctor/action/checkup/store-nurse/{checkup}', [App\Http\Controllers\Doctor\CheckupController::class, 'storeNurse']);

Route::get('/doctor/action/recipe', [App\Http\Controllers\Doctor\RecipeController::class, 'index']);
Route::post('/doctor/action/recipe/{checkup}/add', [App\Http\Controllers\Doctor\RecipeController::class, 'add']);
Route::post('/doctor/action/recipe/store/{checkup}', [App\Http\Controllers\Doctor\RecipeController::class, 'store']);
Route::post('/doctor/action/recipe/{checkup}/detail', [App\Http\Controllers\Doctor\RecipeController::class, 'detail']);

Route::get('/doctor/medical-reports', [App\Http\Controllers\Doctor\MedicalReportController::class, 'index']);
Route::post('/doctor/medical-reports/{patient}/detail', [App\Http\Controllers\Doctor\MedicalReportController::class, 'detail']);
Route::post('/doctor/medical-reports/{patient}/print', [App\Http\Controllers\Doctor\MedicalReportController::class, 'print']);

Route::get('/doctor/medical-resume', [App\Http\Controllers\Doctor\MedicalResumeController::class, 'index']);
Route::get('/doctor/medical-resume/{checkup}/print', [App\Http\Controllers\Doctor\MedicalResumeController::class, 'printResume']);
Route::get('/doctor/medical-resume/{checkup}/detail', [App\Http\Controllers\Doctor\MedicalResumeController::class, 'detail']);
Route::post('/doctor/medical-resume/{checkup}/detail/send', [App\Http\Controllers\Doctor\MedicalResumeController::class, 'store']);

Route::get('/doctor/report-checkup', [App\Http\Controllers\Doctor\ReportController::class, 'listCheckup']);
Route::get('/doctor/report-checkup/print', [App\Http\Controllers\Doctor\ReportController::class, 'printCheckup']);
Route::post('/doctor/report-checkup/code/print', [App\Http\Controllers\Doctor\ReportController::class, 'printCodeCheckup']);
Route::post('/doctor/report-checkup/date/print', [App\Http\Controllers\Doctor\ReportController::class, 'printDateCheckup']);
Route::get('/doctor/report-recipe', [App\Http\Controllers\Doctor\ReportController::class, 'listRecipe']);
Route::get('/doctor/report-recipe/print', [App\Http\Controllers\Doctor\ReportController::class, 'printRecipe']);
Route::post('/doctor/report-recipe/code/print', [App\Http\Controllers\Doctor\ReportController::class, 'printCodeRecipe']);
Route::post('/doctor/report-recipe/date/print', [App\Http\Controllers\Doctor\ReportController::class, 'printDateRecipe']);

Route::get('/doctor/informed-consent', [App\Http\Controllers\Doctor\InformedConsentController::class, 'index']);
Route::get('/doctor/informed-consent/agreement-form/{checkup}', [App\Http\Controllers\Doctor\InformedConsentController::class, 'agreementForm']);
Route::get('/doctor/informed-consent/rejection-form/{checkup}', [App\Http\Controllers\Doctor\InformedConsentController::class, 'rejectionForm']);

Route::get('/doctor/medical', [App\Http\Controllers\Doctor\MedicalController::class, 'index']);