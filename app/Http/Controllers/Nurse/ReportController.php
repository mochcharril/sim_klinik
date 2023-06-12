<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Medicine;
use PDF;

class ReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:perawat']);
    }

    public function listCheckup(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();
            
            return view('nurse.pages.report.checkups-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printCheckup(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $this->param['start_date'] = "semua";
            $this->param['end_date'] = "semua";
            $this->param['countData'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->count();
            $this->param['register_as'] = 'no';

            $pdf = PDF::loadview('nurse.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printCodeCheckup(Request $request){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.patient_id', $request->patient)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $this->param['start_date'] = "semua";
            $this->param['end_date'] = "semua";
            $this->param['countData'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.patient_id', $request->patient)
                                            ->count();
            $this->param['register_as'] = 'no';

            $pdf = PDF::loadview('nurse.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printDateCheckup(Request $request){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->whereBetween('checkups.checkup_date', [$request->date_start, $request->date_end])
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $this->param['start_date'] = $request->date_start;
            $this->param['end_date'] = $request->date_end;
            $this->param['countData'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->whereBetween('checkups.checkup_date', [$request->date_start, $request->date_end])
                                            ->count();
            $this->param['register_as'] = 'no';

            $pdf = PDF::loadview('nurse.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printAsCheckup(Request $request){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('patients.register_as', $request->register_as)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $this->param['start_date'] = "semua";
            $this->param['end_date'] = "semua";
            $this->param['countData'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('patients.register_as', $request->register_as)
                                            ->count();
            $this->param['register_as'] = $request->register_as;

            $pdf = PDF::loadview('admin.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
