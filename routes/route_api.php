<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

Route::get('/getMedicine/{medicine}', [RedirectController::class, 'getMedicine']);
Route::get('/getReportCheckup/{patient}', [RedirectController::class, 'getReportCheckup']);
Route::get('/getReportCheckupDate/{start_date}/{end_date}', [RedirectController::class, 'getReportCheckupDate']);
Route::get('/getReportCheckup/as/{register_as}', [RedirectController::class, 'getReportCheckupAs']);
Route::get('/getReportMedicineIncome/{incomingMedicine}', [RedirectController::class, 'getReportMedicineIncome']);
Route::get('/getReportMedicineIncomeDate/{start_date}/{end_date}', [RedirectController::class, 'getReportMedicineIncomeDate']);
Route::get('/getReportRecipe/{recipe}', [RedirectController::class, 'getReportRecipe']);
Route::get('/getReportRecipeDate/{start_date}/{end_date}', [RedirectController::class, 'getReportRecipeDate']);
Route::get('/getReportPayment/{payment}', [RedirectController::class, 'getReportPayment']);
Route::get('/getReportPaymentDate/{start_date}/{end_date}', [RedirectController::class, 'getReportPaymentDate']);
Route::get('/getReportPatient/as/{register_as}', [RedirectController::class, 'getReportPatientAs']);