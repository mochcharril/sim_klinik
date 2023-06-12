<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Measure;

class MedicalController extends Controller
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
            $this->param['getPatient'] = Patient::orderBy('updated_at', 'desc')->get();

            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes', 'checkups.status_resume')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.status_rm', '1')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            return view('doctor.pages.medical.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
