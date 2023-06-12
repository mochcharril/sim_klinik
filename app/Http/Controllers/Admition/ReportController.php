<?php

namespace App\Http\Controllers\Admition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use PDF;

class ReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admisi']);
    }

    public function listPatient(){
        try {
            $this->param['getPatient'] = Patient::all();
            
            return view('admition.pages.report.patient-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printPatient(){
        try {
            $this->param['register_as'] = 'no';
            $this->param['getPatient'] = Patient::all();
            $pdf = PDF::loadview('admition.pages.report.patient-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-pasien', array("Attachment" => false));
            
            return view('admition.pages.report.patient-print', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printAsPatient(Request $request){
        try {
            $this->param['register_as'] = $request->register_as;
            $this->param['getPatient'] = Patient::where('register_as', $request->register_as)->get();
            $pdf = PDF::loadview('admition.pages.report.patient-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-pasien', array("Attachment" => false));
            return view('admition.pages.report.patient-print', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
