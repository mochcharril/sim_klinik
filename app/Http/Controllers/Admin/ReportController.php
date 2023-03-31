<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Medicine;
use PDF;

class ReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function listPatient(){
        try {
            $this->param['getPatient'] = Patient::all();
            
            return view('admin.pages.report.patient-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printPatient(){
        try {
            $this->param['getPatient'] = Patient::all();
            $pdf = PDF::loadview('admin.pages.report.patient-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-pasien', array("Attachment" => false));
            
            return view('admin.pages.report.patient-print', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listMedicine(){
        try {
            $this->param['getMedicine'] = Medicine::all();
            
            return view('admin.pages.report.medicine-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printMedicine(){
        try {
            $this->param['getMedicine'] = Medicine::all();
            $pdf = PDF::loadview('admin.pages.report.medicine-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listMedicineIncoming(){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->get();
            
            return view('admin.pages.report.medicine-incoming-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function printMedicineIncoming(){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->get();
            $pdf = PDF::loadview('admin.pages.report.medicine-incoming-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listCheckup(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.diagnosis')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();
            
            return view('admin.pages.report.checkups-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printCheckup(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.diagnosis')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
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
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.diagnosis')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.patient_id', $request->patient)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
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
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.diagnosis')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->whereBetween('checkups.checkup_date', [$request->date_start, $request->date_end])
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
