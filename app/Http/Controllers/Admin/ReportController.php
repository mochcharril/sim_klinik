<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\IncomingMedicine;
use App\Models\Payment;
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
            $this->param['register_as'] = 'no';
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
    public function printAsPatient(Request $request){
        try {
            $this->param['register_as'] = $request->register_as;
            $this->param['getPatient'] = Patient::where('register_as', $request->register_as)->get();
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
            $this->param['getListMedicineIncoming'] = IncomingMedicine::all();
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
    public function printCodeMedicineIncoming(Request $request){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->where('incoming_medicine_details.incoming_medicine_id', $request->incoming_medicine)
                                                        ->get();
            $pdf = PDF::loadview('admin.pages.report.medicine-incoming-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printDateMedicineIncoming(Request $request){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->whereBetween('incoming_medicines.date_income_medicine', [$request->date_start, $request->date_end])
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
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
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

            $pdf = PDF::loadview('admin.pages.report.checkups-print', $this->param)->setPaper('legal', 'landscape');
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

    public function listRecipe(){
        try {
            $this->param['getFilterRecipe'] = \DB::table('recipes')
                                                    ->select('recipes.*')
                                                    ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                                    ->where('checkups.status_rm', '1')
                                                    ->get();
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            return view('admin.pages.report.recipe-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printRecipe(){
        try {
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.recipe-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printCodeRecipe(Request $request){
        try {
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->where('recipes.id', $request->recipe)
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.recipe-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printDateRecipe(Request $request){
        try {
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->whereBetween('recipes.date_recipe', [$request->date_start, $request->date_end])
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.recipe-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listPayment(){
        try {
            $this->param['getFilterPayment'] = Payment::all();
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->get();

            return view('admin.pages.report.payment-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printPayment(){
        try {
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.payment-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printCodePayment(Request $request){
        try {
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->where('payments.id', $request->payment)
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.payment-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printDatePayment(Request $request){
        try {
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->whereBetween('payments.date_payment', [$request->date_start, $request->date_end])
                                            ->get();

            $pdf = PDF::loadview('admin.pages.report.payment-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listTopSick(){
        try {
            $this->param['getTopSick'] = \DB::table('checkups')
                                            ->select('code_diagnosis', 'description_diagnosis', \DB::raw('count(*) as total'))
                                            ->groupBy('code_diagnosis', 'description_diagnosis')
                                            ->orderByDesc('total')
                                            ->get();
            
            return view('admin.pages.report.top-sick-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printTopSick(){
        try {
            $this->param['getTopSick'] = \DB::table('checkups')
                                            ->select('code_diagnosis', 'description_diagnosis', \DB::raw('count(*) as total'))
                                            ->groupBy('code_diagnosis', 'description_diagnosis')
                                            ->orderByDesc('total')
                                            ->get();
            $pdf = PDF::loadview('admin.pages.report.top-sick-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-top-penyakit', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
