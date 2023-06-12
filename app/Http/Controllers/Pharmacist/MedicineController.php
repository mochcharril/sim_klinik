<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:apoteker']);
    }

    public function index(){
        try {
            $this->param['getMedicine'] = Medicine::orderBy('updated_at', 'desc')->get();
            
            return view('pharmacist.pages.medicine.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            $this->param['getCodeMD'] = Medicine::generateCodeMD();

            return view('pharmacist.pages.medicine.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'code_md' => 'required',
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'expired_date' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_md' => 'Kode MD',
                'name' => 'Nama Obat',
                'price' => 'Harga Obat',
                'expired_date' => 'Tanggal Kadaluarsa',
            ],
        );
        try {
            $medicine = new Medicine();
            $medicine->code_md = $request->code_md;
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->stock = $request->stock;
            $medicine->expired_date = $request->expired_date;
            $medicine->save();

            return redirect('/pharmacist/master-data/medicine')->withStatus('Berhasil menambah data obat.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(Medicine $medicine){
        try {
            $this->param['getDetailMedicine'] = Medicine::find($medicine->id);
            return view('pharmacist.pages.medicine.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, Medicine $medicine){
        $this->validate($request,
            [
                'code_md' => 'required',
                'name' => 'required',
                'price' => 'required',
                'expired_date' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'code_md' => 'Kode MD',
                'name' => 'Nama Obat',
                'price' => 'Harga Obat',
                'expired_date' => 'Tanggal Kadaluarsa',
            ],
        );
        try {
            $medicine = Medicine::find($medicine->id);
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->expired_date = $request->expired_date;
            $medicine->save();

            return redirect('/pharmacist/master-data/medicine')->withStatus('Berhasil memperbarui data obat.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(Medicine $medicine){
        try {
            Medicine::find($medicine->id)->delete();
            return redirect('/pharmacist/master-data/medicine')->withStatus('Berhasil menghapus data obat.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
