<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poly;
use App\Models\Checkup;
use App\Models\Patient;

class PolyController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getPoly'] = Poly::all();
            $this->param['countUmum'] = Checkup::where('poly_id', 1)->count();
            $this->param['countGigi'] = Checkup::where('poly_id', 2)->count();
            $this->param['countKIA'] = Checkup::where('poly_id', 3)->count();
            
            return view('admin.pages.poly.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            $this->param['getCodePL'] = Poly::generateCodePL();

            return view('admin.pages.poly.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'code_pl' => 'required',
                'name' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_pl' => 'Kode PL',
                'name' => 'Nama Poli Klinik',
            ],
        );
        try {
            $poly = new Poly();
            $poly->code_pl = $request->code_pl;
            $poly->name = $request->name;
            $poly->save();

            return redirect('/admin/master-data/poly')->withStatus('Berhasil menambah data poli klinik.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(Poly $poly){
        try {
            $this->param['getDetailPoly'] = Poly::find($poly->id);
            return view('admin.pages.poly.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, Poly $poly){
        $this->validate($request,
            [
                'code_pl' => 'required',
                'name' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_pl' => 'Kode PL',
                'name' => 'Nama Poli Klinik',
            ],
        );

        try {
            $poly = Poly::find($poly->id);
            $poly->code_pl = $request->code_pl;
            $poly->name = $request->name;
            $poly->save();

            return redirect('/admin/master-data/poly')->withStatus('Berhasil memperbarui data poli klinik.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(Poly $poly){
        try {
            Poly::find($poly->id)->delete();
            return redirect('/admin/master-data/poly')->withStatus('Berhasil menghapus data poli klinik.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function detailGeneral(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.poly_id', 1)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();

            return view('admin.pages.poly.detail-general', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detailTeeth(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.poly_id', 2)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();

            return view('admin.pages.poly.detail-teeth', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detailKia(){
        try {
            $this->param['getCheckup'] = \DB::table('checkups')
                                            ->select('checkups.checkup_date', 'checkups.id', 'patients.code_rm', 'checkups.code_cu', 'patients.name as patient_name', 'checkups.complaint', 'checkups.code_diagnosis', 'checkups.description_diagnosis', 'checkups.other_notes')
                                            ->join('patients', 'checkups.patient_id', 'patients.id')
                                            ->where('checkups.poly_id', 3)
                                            ->get();

            $this->param['getMeasureDetail'] = \DB::table('measure_patient_details')
                                            ->select('measures.name', 'measure_patient_details.measure_patient_id', 'measure_patients.checkup_id')
                                            ->join('measure_patients', 'measure_patient_details.measure_patient_id', 'measure_patients.id')
                                            ->join('measures', 'measure_patient_details.measure_id', 'measures.id')
                                            ->get();
            $this->param['getPatient'] = Patient::all();

            return view('admin.pages.poly.detail-kia', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
