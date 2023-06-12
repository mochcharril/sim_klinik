<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineRule;

class MedicineRuleController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:apoteker']);
    }

    public function index(){
        try {
            $this->param['getMedicineRule'] = MedicineRule::orderBy('updated_at', 'desc')->get();
            
            return view('pharmacist.pages.medicine_rule.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('pharmacist.pages.medicine_rule.add');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'name' => 'Nama Obat',
            ],
        );
        try {
            $medicine_rule = new MedicineRule();
            $medicine_rule->name = $request->name;
            $medicine_rule->save();

            return redirect('/pharmacist/master-data/medicine_rule')->withStatus('Berhasil menambah data aturan pakai.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(MedicineRule $medicine_rule){
        try {
            $this->param['getDetailMedicineRule'] = MedicineRule::find($medicine_rule->id);
            return view('pharmacist.pages.medicine_rule.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, MedicineRule $medicine_rule){
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'name' => 'Nama Obat',
            ],
        );
        try {
            $medicine_rule = MedicineRule::find($medicine_rule->id);
            $medicine_rule->name = $request->name;
            $medicine_rule->save();

            return redirect('/pharmacist/master-data/medicine_rule')->withStatus('Berhasil memperbarui data aturan pakai.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(MedicineRule $medicine_rule){
        try {
            MedicineRule::find($medicine_rule->id)->delete();
            return redirect('/pharmacist/master-data/medicine_rule')->withStatus('Berhasil menghapus data aturan pakai.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
