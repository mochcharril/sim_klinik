<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Measure;
use App\Models\Checkup;
use App\Models\MeasurePatient;
use App\Models\MeasurePatientDetail;

class CheckupController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:perawat']);
    }

    public function index(){
        try {
            $this->param['getPatient'] = Patient::orderBy('updated_at', 'desc')->get();
            return view('nurse.pages.checkup.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(Patient $patient){
        try {
            $this->param['generateCodeCU'] = Checkup::generateCodeCU();
            $this->param['getDetailPatient'] = Patient::find($patient->id);
            $this->param['getPoly'] = Poly::all();
            $this->param['getMeasure'] = Measure::all();
            // $this->param['getCheckupHistory'] = Checkup::where('patient_id', $patient->id)->get();
            $this->param['getCheckupHistory'] = \DB::table('checkups')
                                                    ->select('checkups.*', 'polies.name as poly_name')
                                                    ->join('polies', 'checkups.poly_id', 'polies.id')
                                                    ->where('checkups.patient_id', $patient->id)
                                                    ->get();
            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                                    ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                                    ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                    ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                    ->get();

            return view('nurse.pages.checkup.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Patient $patient, Request $request)
    {
        $this->validate($request,
            [
                'code_cu' => 'required',
                'checkup_date' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'blood_preasure' => 'required',
                'temperature' => 'required',
                'poly' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_cu' => 'Kode Pemeriksaan',
                'checkup_date' => 'Tanggal Pemeriksaan',
                'height' => 'Tinggi Badan',
                'weight' => 'Berat Badan',
                'blood_preasure' => 'Tekanan Darah',
                'temperature' => 'Suhu',
                'poly' => 'Poli',
            ],
        );
        try {
            $checkup = new Checkup();
            $checkup->code_cu = $request->get('code_cu');
            $checkup->patient_id = $patient->id;
            $checkup->doctor_nurse_id = auth()->user()->id;
            $checkup->complaint = $request->get('complaint');
            $checkup->height = $request->get('height');
            $checkup->weight = $request->get('weight');
            $checkup->blood_preasure = $request->get('blood_preasure');
            $checkup->temperature = $request->get('temperature');
            $checkup->allergy = '-';
            $checkup->code_diagnosis = '-';
            $checkup->description_diagnosis = '-';
            $checkup->other_notes = '-';
            $checkup->measures = '-';
            $checkup->poly_id = $request->get('poly');
            $checkup->checkup_date = $request->get('checkup_date');
            $checkup->status_rm = '0';
            $checkup->status_checkup_doctor = '0';
            $checkup->status_resume = '0';
            $checkup->status_informed_consent = 'Menunggu';
            $checkup->save();

            return redirect('/nurse/action/checkup')->withStatus('Berhasil menambah data pemeriksaan.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
