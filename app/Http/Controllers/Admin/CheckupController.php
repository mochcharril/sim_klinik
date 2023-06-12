<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Measure;
use App\Models\Checkup;
use App\Models\CheckupDiagnosisDetail;
use App\Models\MeasurePatient;
use App\Models\MeasurePatientDetail;

class CheckupController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getPatient'] = Patient::orderBy('updated_at', 'desc')->get();
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name', 'patients.phone_number', 'patients.insurance_type', 'patients.date_of_birth')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.status_checkup_doctor', '0')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();
            return view('admin.pages.checkup.list', $this->param);
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
            $this->param['getMeasure'] = Measure::all();
            $this->param['getPoly'] = Poly::all();
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

            return view('admin.pages.checkup.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function addNurse(Checkup $checkup){
        try {
            $this->param['getCheckup'] = Checkup::find($checkup->id);
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getMeasure'] = Measure::all();
            $this->param['getPoly'] = Poly::all();
            // $this->param['getCheckupHistory'] = Checkup::where('patient_id', $patient->id)->get();
            $this->param['getCheckupHistory'] = \DB::table('checkups')
                                                    ->select('checkups.*', 'polies.name as poly_name')
                                                    ->join('polies', 'checkups.poly_id', 'polies.id')
                                                    ->where('checkups.patient_id', $checkup->patient_id)
                                                    ->get();
            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                                    ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                                    ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                    ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                    ->get();

            return view('admin.pages.checkup.add-nurse', $this->param);
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
                'complaint' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'blood_preasure' => 'required',
                'temperature' => 'required',
                'allergy' => 'required',
                'code_diagnosis' => 'required',
                'description_diagnosis' => 'required',
                'other_notes' => 'required',
                'poly' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_cu' => 'Kode Pemeriksaan',
                'checkup_date' => 'Tanggal Pemeriksaan',
                'complaint' => 'Keluhan',
                'height' => 'Tinggi Badan',
                'weight' => 'Berat Badan',
                'blood_preasure' => 'Tekanan Darah',
                'temperature' => 'Suhu',
                'allergy' => 'Alergi',
                'code_diagnosis' => 'Kode Diagnosa',
                'description_diagnosis' => 'Deskripsi Diagnosa',
                'other_notes' => 'Catatan Lain',
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
            $checkup->allergy = $request->get('allergy');
            $checkup->code_diagnosis = $request->get('code_diagnosis');
            $checkup->description_diagnosis = $request->get('description_diagnosis');
            $checkup->other_notes = $request->get('other_notes');
            $checkup->measures = '-';
            $checkup->poly_id = $request->get('poly');
            $checkup->checkup_date = $request->get('checkup_date');
            $checkup->status_rm = '0';
            $checkup->status_checkup_doctor = '1';
            $checkup->status_resume = '0';
            $checkup->save();

            $lengthMeasure = count($request->get('measure'));
            $tempTotal = 0;
            for ($h=0; $h < $lengthMeasure; $h++) {
                $measure = Measure::find($request->get('measure')[$h]);
                $tempTotal+=(int)$measure->price;
            }


            $measurePatient = new MeasurePatient();
            $measurePatient->code_msp = MeasurePatient::generateCodeMSP();
            $measurePatient->checkup_id = $checkup->id;
            $measurePatient->doctor_id = auth()->user()->id;
            $measurePatient->total = $tempTotal;
            $measurePatient->date_measure_patient = $request->get('checkup_date');
            $measurePatient->save();

            for ($i=0; $i < $lengthMeasure ; $i++) {
                $measurePatientDetail = new MeasurePatientDetail();
                $measurePatientDetail->measure_patient_id = $measurePatient->id;
                $measurePatientDetail->measure_id = $request->get('measure')[$i];
                $measurePatientDetail->save();
            }

            $lengthDiagnosisOther = count((array)$request->get('code_diagnosis_other'));
            // dd($lengthDiagnosisOther);
            if ($lengthDiagnosisOther > 0) {
                for ($j=0; $j < $lengthDiagnosisOther; $j++) {
                    $checkupDiagnosisOther = new CheckupDiagnosisDetail();
                    $checkupDiagnosisOther->checkup_id = $checkup->id;
                    $checkupDiagnosisOther->code_diagnosis = $request->get('code_diagnosis_other')[$j];
                    $checkupDiagnosisOther->description_diagnosis = $request->get('description_diagnosis_other')[$j];
                    $checkupDiagnosisOther->save();
                }
            }

            $updatePatient = Patient::find($patient->id);
            $updatePatient->updated_at = now();
            $updatePatient->save();

            return redirect('/admin/action/checkup')->withStatus('Berhasil menambah data pemeriksaan.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function storeNurse(Checkup $checkup, Request $request)
    {
        $this->validate($request,
            [
                'checkup_date' => 'required',
                'complaint' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'blood_preasure' => 'required',
                'temperature' => 'required',
                'allergy' => 'required',
                'code_diagnosis' => 'required',
                'description_diagnosis' => 'required',
                'other_notes' => 'required',
                'poly' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'checkup_date' => 'Tanggal Pemeriksaan',
                'complaint' => 'Keluhan',
                'height' => 'Tinggi Badan',
                'weight' => 'Berat Badan',
                'blood_preasure' => 'Tekanan Darah',
                'temperature' => 'Suhu',
                'allergy' => 'Alergi',
                'code_diagnosis' => 'Kode Diagnosa',
                'description_diagnosis' => 'Deskripsi Diagnosa',
                'other_notes' => 'Catatan Lain',
                'poly' => 'Poli',
            ],
        );
        try {
            $updateCheckup = Checkup::find($checkup->id);
            $updateCheckup->doctor_nurse_id = auth()->user()->id;
            $updateCheckup->complaint = $request->get('complaint');
            $updateCheckup->height = $request->get('height');
            $updateCheckup->weight = $request->get('weight');
            $updateCheckup->blood_preasure = $request->get('blood_preasure');
            $updateCheckup->temperature = $request->get('temperature');
            $updateCheckup->allergy = $request->get('allergy');
            $updateCheckup->code_diagnosis = $request->get('code_diagnosis');
            $updateCheckup->description_diagnosis = $request->get('description_diagnosis');
            $updateCheckup->other_notes = $request->get('other_notes');
            $updateCheckup->measures = '-';
            $updateCheckup->poly_id = $request->get('poly');
            $updateCheckup->checkup_date = $request->get('checkup_date');
            $updateCheckup->status_rm = '0';
            $updateCheckup->status_checkup_doctor = '1';
            $updateCheckup->status_resume = '0';
            $updateCheckup->save();

            $lengthMeasure = count($request->get('measure'));
            $tempTotal = 0;
            for ($h=0; $h < $lengthMeasure; $h++) {
                $measure = Measure::find($request->get('measure')[$h]);
                $tempTotal+=(int)$measure->price;
            }


            $measurePatient = new MeasurePatient();
            $measurePatient->code_msp = MeasurePatient::generateCodeMSP();
            $measurePatient->checkup_id = $checkup->id;
            $measurePatient->doctor_id = auth()->user()->id;
            $measurePatient->total = $tempTotal;
            $measurePatient->date_measure_patient = $request->get('checkup_date');
            $measurePatient->save();

            for ($i=0; $i < $lengthMeasure ; $i++) {
                $measurePatientDetail = new MeasurePatientDetail();
                $measurePatientDetail->measure_patient_id = $measurePatient->id;
                $measurePatientDetail->measure_id = $request->get('measure')[$i];
                $measurePatientDetail->save();
            }

            $lengthDiagnosisOther = count((array)$request->get('code_diagnosis_other'));
            // dd($lengthDiagnosisOther);
            if ($lengthDiagnosisOther > 0) {
                for ($j=0; $j < $lengthDiagnosisOther; $j++) {
                    $checkupDiagnosisOther = new CheckupDiagnosisDetail();
                    $checkupDiagnosisOther->checkup_id = $checkup->id;
                    $checkupDiagnosisOther->code_diagnosis = $request->get('code_diagnosis_other')[$j];
                    $checkupDiagnosisOther->description_diagnosis = $request->get('description_diagnosis_other')[$j];
                    $checkupDiagnosisOther->save();
                }
            }

            $updatePatient = Patient::find($checkup->patient_id);
            $updatePatient->updated_at = now();
            $updatePatient->save();

            return redirect('/admin/action/checkup')->withStatus('Berhasil menambah data pemeriksaan.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
