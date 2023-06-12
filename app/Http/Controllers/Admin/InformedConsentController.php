<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Patient;
use App\Models\User;
use App\Models\Poly;
use PDF;

class InformedConsentController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getCheckupYes'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'patients.code_rm', 'patients.name as patient_name', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date', 'checkups.status_rm')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->where('checkups.status_informed_consent', 'Ya')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();
            $this->param['getMeasureDetailYes'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->orderBy('measure_patient_details.updated_at', 'desc')
                                            ->get();

            $this->param['getCheckupNo'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'patients.code_rm', 'patients.name as patient_name', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date', 'checkups.status_rm')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->where('checkups.status_informed_consent', 'Tidak')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();
            $this->param['getMeasureDetailNo'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->orderBy('measure_patient_details.updated_at', 'desc')
                                            ->get();

            return view('admin.pages.informed-consent.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function agreementForm(Checkup $checkup){
        $this->param['getPatient'] = Patient::find($checkup->patient_id);
        $this->param['getCheckup'] = Checkup::find($checkup->id);
        $this->param['getUser'] = User::find($checkup->doctor_nurse_id);
        $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->where('measure_patients.checkup_id', $checkup->id)
                                            ->get();

        $pdf = PDF::loadview('admin.pages.informed-consent.print-agreement-form', $this->param)->setPaper('legal');
        return $pdf->stream('cetak-form-persetujuan-tindakan-dokter', array("Attachment" => false));
    }

    public function rejectionForm(Checkup $checkup){
        $this->param['getPatient'] = Patient::find($checkup->patient_id);
        $this->param['getCheckup'] = Checkup::find($checkup->id);
        $this->param['getPoly'] = Poly::find($checkup->poly_id);
        $this->param['getUser'] = User::find($checkup->doctor_nurse_id);

        $pdf = PDF::loadview('admin.pages.informed-consent.print-rejection-form', $this->param)->setPaper('legal');
        return $pdf->stream('cetak-form-penolakan-tindakan-dokter', array("Attachment" => false));
    }
}
