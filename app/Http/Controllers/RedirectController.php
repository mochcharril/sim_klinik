<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\IncomingMedicine;
use App\Models\Recipe;
use App\Models\Payment;

class RedirectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roleUser = \Auth::user()->roles()->pluck('name')[0];
        if($roleUser == 'admin'){
            return redirect('/dashboard-admin');
        } elseif ($roleUser == 'dokter'){
            return redirect('/dashboard-doctor');
        } elseif ($roleUser == 'perawat'){
            return redirect('/dashboard-nurse');
        } elseif ($roleUser == 'apoteker'){
            return redirect('/dashboard-pharmacist');
        } elseif ($roleUser == 'admisi'){
            return redirect('/dashboard-admition');
        } elseif ($roleUser == 'klinik'){
            return redirect('/dashboard-clinic');
        } else {
            return redirect('/logout');
        }
    }

    public function getMedicine(Medicine $medicine){
        try {
            $this->param['getMedicineDetail'] = Medicine::find($medicine->id);
            return response()->json($this->param['getMedicineDetail']);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportCheckup(Patient $patient){
        try {
            $this->param['getReportPatient'] = \DB::table('checkups')
                                                    ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                                    ->join('patients', 'checkups.patient_id', 'patients.id')
                                                    ->where('checkups.patient_id', $patient->id)
                                                    ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                                    ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                                    ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                    ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                    ->get();

            // return response()->json(["data" =>$this->param['getReportPatient']]);
            // return response()->json($this->param['getReportPatient']);
            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function getReportCheckupDate($start_date, $end_date){
        try {
            $this->param['getReportPatient'] = \DB::table('checkups')
                                                    ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                                    ->join('patients', 'checkups.patient_id', 'patients.id')
                                                    ->whereBetween('checkups.checkup_date', [$start_date, $end_date])
                                                    ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                                    ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                                    ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                    ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                    ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportCheckupAs($register_as){
        try {
            $this->param['getReportPatient'] = \DB::table('checkups')
                                                    ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                                    ->join('patients', 'checkups.patient_id', 'patients.id')
                                                    ->where('patients.register_as', $register_as)
                                                    ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                                    ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                                    ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                    ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                    ->get();

            // return response()->json(["data" =>$this->param['getReportPatient']]);
            // return response()->json($this->param['getReportPatient']);
            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportMedicineIncome(IncomingMedicine $incomingMedicine){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->where('incoming_medicine_details.incoming_medicine_id', $incomingMedicine->id)
                                                        ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function getReportMedicineIncomeDate($start_date, $end_date){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->whereBetween('incoming_medicines.date_income_medicine', [$start_date, $end_date])
                                                        ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportRecipe(Recipe $recipe){
        try {
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->where('recipes.id', $recipe->id)
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function getReportRecipeDate($start_date, $end_date){
        try {
            $this->param['getRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.date_recipe', 'recipes.code_rp', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor', 'medicines.name as medicine', 'recipe_details.medication_rules', 'recipe_details.qty', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('checkups', 'recipes.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('checkups.status_rm', '1')
                                            ->whereBetween('recipes.date_recipe', [$start_date, $end_date])
                                            ->orderBy('recipes.code_rp', 'asc')
                                            ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportPayment(Payment $payment){
        try {
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->where('payments.id', $payment->id)
                                            ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function getReportPaymentDate($start_date, $end_date){
        try {
            $this->param['getPayment'] = \DB::table('payments')
                                            ->select('payments.date_payment', 'payments.code_py', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as cashier', 'payments.total')
                                            ->join('checkups', 'payments.checkup_id', 'checkups.id')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'payments.admin_id', 'users.id')
                                            ->whereBetween('payments.date_payment', [$start_date, $end_date])
                                            ->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getReportPatientAs($register_as){
        try {
            $this->param['getReportPatient'] = Patient::where('register_as', $register_as)->get();

            return response()->json($this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
