<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkup;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\User;

use PDF;

class PaymentController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.id', 'checkups.code_cu', 'patients.name as patient_name', 'users.name as doctor_nurse_name', 'checkups.complaint', 'checkups.height', 'checkups.weight', 'checkups.blood_preasure', 'checkups.allergy', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.measures', 'polies.name as poly_name', 'checkups.checkup_date', 'checkups.status_rm')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->join('users', 'checkups.doctor_nurse_id', 'users.id')
                                            ->join('polies', 'checkups.poly_id', 'polies.id')
                                            ->where('checkups.status_rm', '1')
                                            ->orderBy('checkups.updated_at', 'desc')
                                            ->get();
            $this->param['filterPayment'] = Payment::all();

            return view('admin.pages.payment.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(Checkup $checkup){
        try {
            $this->param['generateCodePY'] = Payment::generateCodePY();
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);

            $this->param['getDetailMeasure'] = \DB::table('measure_patient_details')
                                                ->select('measures.name', 'measures.price')
                                                ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                ->where('measure_patients.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                                ->select('medicines.name', 'medicines.price', 'recipe_details.qty', 'recipe_details.total')
                                                ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                                ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                                ->where('recipes.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailPayment'] = Payment::where('checkup_id', $checkup->id)->first();

            return view('admin.pages.payment.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request, Checkup $checkup){
        $this->validate($request,
            [
                'code_py' => 'required',
                'date_payment' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_py' => 'Kode Pembayaran',
                'date_payment' => 'Tanggal Pembayaran',
            ],
        );
        try {
            $payment = new Payment();
            $payment->code_py = $request->code_py;
            $payment->checkup_id = $checkup->id;
            $payment->total = $request->total;
            $payment->admin_id = auth()->user()->id;
            $payment->date_payment = $request->date_payment;
            $payment->status_payments = 'Sudah Dibayar';
            $payment->save();

            return redirect('/admin/payment')->withStatus('Berhasil menambah data pembayaran .');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detail(Checkup $checkup){
        try {
            $this->param['generateCodePY'] = Payment::generateCodePY();
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);

            $this->param['getDetailMeasure'] = \DB::table('measure_patient_details')
                                                ->select('measures.name', 'measures.price')
                                                ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                ->where('measure_patients.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                                ->select('medicines.name', 'medicines.price', 'recipe_details.qty', 'recipe_details.total')
                                                ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                                ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                                ->where('recipes.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailPayment'] = Payment::where('checkup_id', $checkup->id)->first();

            return view('admin.pages.payment.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function print(Checkup $checkup){
        try {
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);
            $this->param['getDoctor'] = User::find($checkup->doctor_nurse_id);

            $this->param['getDetailMeasure'] = \DB::table('measure_patient_details')
                                                ->select('measures.name', 'measures.price')
                                                ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                ->where('measure_patients.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                                ->select('medicines.name', 'medicines.price', 'recipe_details.qty', 'recipe_details.total')
                                                ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                                ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                                ->where('recipes.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailPayment'] = Payment::where('checkup_id', $checkup->id)->first();

            $pdf = PDF::loadview('admin.pages.payment.print', $this->param);
            // return $pdf->download('cetak-pdf-pasien');
            return $pdf->stream('Detail-Nota-Pemeriksaan', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function printNota(Checkup $checkup){
        try {
            $this->param['getDetailPatient'] = Patient::find($checkup->patient_id);
            $this->param['getDetailCheckup'] = Checkup::find($checkup->id);
            $this->param['getDoctor'] = User::find($checkup->doctor_nurse_id);

            $this->param['getDetailMeasure'] = \DB::table('measure_patient_details')
                                                ->select('measures.name', 'measures.price')
                                                ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                                ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                                ->where('measure_patients.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailRecipe'] = \DB::table('recipe_details')
                                                ->select('medicines.name', 'medicines.price', 'recipe_details.qty', 'recipe_details.total')
                                                ->join('medicines', 'recipe_details.medicine_id', 'medicines.id')
                                                ->join('recipes', 'recipe_details.recipe_id', 'recipes.id')
                                                ->where('recipes.checkup_id', $checkup->id)
                                                ->get();
            $this->param['getDetailPayment'] = Payment::where('checkup_id', $checkup->id)->first();

            $pdf = PDF::loadview('admin.pages.payment.print-nota', $this->param);
            // return $pdf->download('cetak-pdf-pasien');
            return $pdf->stream('cetak-pdf-nota-pembayaran', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
