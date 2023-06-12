<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\Measure;
use App\Models\CheckupDiagnosisDetail;
use App\Models\MedicalResume;

use PDF;

class MedicalResumeReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
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
                                            ->orderBy('measure_patient_details.updated_at', 'desc')
                                            ->get();

            return view('admin.pages.medical_resume.list', $this->param);
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

            return view('admin.pages.medical_resume.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request, Checkup $checkup){
        $this->validate($request,
            [
                'date_out' => 'required',
                'reason_mrs' => 'required',
                'abnormality' => 'required',
                'result' => 'required',
                'diagnosa_first' => 'required',
                'operatif' => 'required',
                'dilit' => 'required',
                'farmakology' => 'required',
                'other_teraphy' => 'required',
                'consultation' => 'required',
                'date_control' => 'required',
                'place_control' => 'required',
                'time_control' => 'required',
                'doctor_name' => 'required',
                'hospital_name' => 'required',
                'condition' => 'required',
                'next_checkup' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'date_out' => 'Tanggal Keluar',
                'reason_mrs' => 'Alasan Masuk MRS',
                'abnormality' => 'Kelainan dan Lainnya',
                'result' => 'Hasil Pemeriksaan',
                'diagnosa_first' => 'Diagnosa Awal',
                'operatif' => 'Operatif / Non Operatif',
                'dilit' => 'Terapi Dilit',
                'farmakology' => 'Terapi Farmakologi',
                'other_teraphy' => 'Terapi Pengobatan Lainnya',
                'consultation' => 'Konsultasi',
                'date_control' => 'Kontrol Tanggal',
                'place_control' => 'Tempat',
                'time_control' => 'Jam / Pukul',
                'doctor_name' => 'Nama Dokter',
                'hospital_name' => 'Kondisi Mendesak Dibawa',
                'condition' => 'Kondisi',
                'next_checkup' => 'Lanjutan Pengobatan',
            ],
        );
        try {
            $resume = new MedicalResume();
            $resume->checkup_id = $checkup->id;
            $resume->date_out = $request->date_out;
            $resume->reason_mrs = $request->reason_mrs;
            $resume->abnormality = $request->abnormality;
            $resume->result = $request->result;
            $resume->diagnosa_first = $request->diagnosa_first;
            $resume->operatif = $request->operatif;
            $resume->dilit = $request->dilit;
            $resume->farmakology = $request->farmakology;
            $resume->other_teraphy = $request->other_teraphy;
            $resume->consultation = $request->consultation;
            $resume->date_control = $request->date_control;
            $resume->place_control = $request->place_control;
            $resume->time_control = $request->time_control;
            $resume->doctor_name = $request->doctor_name;
            $resume->hospital_name = $request->hospital_name;
            $resume->condition = $request->condition;
            $resume->next_checkup = $request->next_checkup;
            $resume->save();

            $updateCheckup = Checkup::find($checkup->id);
            $updateCheckup->status_resume = '1';
            $updateCheckup->save();

            return redirect('/admin/medical-resume')->withStatus('Berhasil Menambahkan Data Resume Medis');

        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function printResume(Checkup $checkup){
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
            $this->param['getResume'] = MedicalResume::where('checkup_id', $checkup->id)->first();

            $pdf = PDF::loadview('admin.pages.medical_resume.print', $this->param);
            // return $pdf->download('cetak-pdf-pasien');
            return $pdf->stream('cetak-pdf-rekam-medis', array("Attachment" => false));
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
