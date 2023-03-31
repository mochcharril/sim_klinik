<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Poly;

class DashboardController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:klinik']);
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
            $this->param['countPoly'] = Poly::count();
            
            return view('clinic.pages.dashboard.dashboard', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
