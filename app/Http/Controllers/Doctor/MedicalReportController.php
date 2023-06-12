<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Measure;

use PDF;

class MedicalReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:dokter']);
    }

    public function index(){
        try {
            $this->param['filterCheckup'] = \DB::table('checkups')
                                            ->select('checkups.patient_id')
                                            ->where('checkups.status_rm', '1')
                                            ->groupBy('checkups.patient_id')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();
            $this->param['getPatient'] = Patient::all();
            return view('doctor.pages.medical_reports.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detail(Patient $patient)
    {
        try {
            $this->param['getPatient'] = Patient::find($patient->id);
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->where('checkups.patient_id', $patient->id)
                                            ->get();
            $this->param['getMeasure'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.checkup_id as checkup_id', 'recipes.code_rp', 'recipes.date_recipe', 'users.name as doctor_name', 'medicines.name as medicine_name', 'recipe_details.qty', 'recipe_details.medication_rules', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->get();

            return view('doctor.pages.medical_reports.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function print(Patient $patient){
        try {
            $this->param['getDetailPatient'] = Patient::find($patient->id);
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->where('checkups.patient_id', $patient->id)
                                            ->get();
            $this->param['getMeasure'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                            ->select('recipes.checkup_id as checkup_id', 'recipes.code_rp', 'recipes.date_recipe', 'users.name as doctor_name', 'medicines.name as medicine_name', 'recipe_details.qty', 'recipe_details.medication_rules', 'recipe_details.total')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->join('users', 'recipes.doctor_id', 'users.id')
                                            ->get();

            $pdf = PDF::loadview('doctor.pages.medical_reports.print', $this->param);
            // return $pdf->download('cetak-pdf-pasien');
            return $pdf->stream('cetak-pdf-rekam-medis', array("Attachment" => false));

        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
