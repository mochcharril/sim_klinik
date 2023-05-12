<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Measure;
use App\Models\CheckupDiagnosisDetail;

use PDF;

class MedicalResumeController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:dokter']);
    }

    public function index(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.status_rm', '1')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();

            return view('doctor.pages.medical_resume.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detail(Checkup $checkup){
        try {
            $this->param['getPatient'] = Patient::find($checkup->patient_id);
            $this->param['getCheckup'] = Checkup::find($checkup->id);
            $this->param['getOtherDiagnosis'] = CheckupDiagnosisDetail::where('checkup_id', $checkup->id)->get();
            $this->param['getMeasure'] = \DB::table('measure_patient_details')
                                            ->select('measures.name')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            // ->join('checkups', 'measure_patients.checkup_id', 'checkups.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->where('measure_patients.checkup_id', $checkup->id)
                                            ->get();
            $this->param['getMedicine'] = \DB::table('recipe_details')
                                            ->select('medicines.name', 'recipe_details.qty', 'recipe_details.medication_rules')
                                            ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                            ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                            ->where('recipes.checkup_id', $checkup->id)
                                            ->get();

            return view('doctor.pages.medical_resume.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
