<?php

namespace App\Http\Controllers\Admition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;

use Carbon\Carbon;

class DashboardController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admisi']);
    }

    public function index(){
        try {
            $countAdmin = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'admin');})->count();
            $countDoctor = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'dokter');})->count();
            $countNurse = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'perawat');})->count();
            $countParmachist = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'apoteker');})->count();
            $countAdmition = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'admisi');})->count();
            $countClinic = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'klinik');})->count();

            $this->param['countPatient'] = Patient::count();
            $this->param['countAdmin'] = $countAdmin;
            $this->param['countDoctor'] = $countDoctor;
            $this->param['countNurse'] = $countNurse;
            $this->param['countParmachist'] = $countParmachist;
            $this->param['countAdmition'] = $countAdmition;
            $this->param['countClinic'] = $countClinic;

            $this->param['getJanuary'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '01')->count();
            $this->param['getFebruary'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '02')->count();
            $this->param['getMarch'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '03')->count();
            $this->param['getApril'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '04')->count();
            $this->param['getMay'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '05')->count();
            $this->param['getJune'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '06')->count();
            $this->param['getJuly'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '07')->count();
            $this->param['getAugust'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '08')->count();
            $this->param['getSeptember'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '09')->count();
            $this->param['getOctober'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '10')->count();
            $this->param['getNovember'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '11')->count();
            $this->param['getDecember'] = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '12')->count();

            $this->param['countRetention'] = Patient::where('updated_at', '<', date('Y-m-d', strtotime('-25 years')))
                                                    ->where('is_retention', 'no')
                                                    ->count();
            
            return view('admition.pages.dashboard.dashboard', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
