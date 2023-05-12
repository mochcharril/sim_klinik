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

require __DIR__.'/route_api.php';
require __DIR__.'/route_admin.php';
require __DIR__.'/route_admition.php';
require __DIR__.'/route_pharmacist.php';
require __DIR__.'/route_clinic.php';
require __DIR__.'/route_doctor.php';
require __DIR__.'/route_nurse.php';
require __DIR__.'/auth.php';
