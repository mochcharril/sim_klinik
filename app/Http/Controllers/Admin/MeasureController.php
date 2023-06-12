<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Measure;

class MeasureController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getMeasure'] = Measure::orderBy('updated_at', 'desc')->get();
            
            return view('admin.pages.measure.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.measure.add');
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
                'price' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'name' => 'Nama Tindakan',
                'price' => 'Harga',
            ],
        );
        try {
            $measure = new Measure();
            $measure->name = $request->name;
            $measure->price = $request->price;
            $measure->save();

            return redirect('/admin/master-data/measure')->withStatus('Berhasil menambah data tindakan.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(Measure $measure){
        try {
            $this->param['getDetailMeasure'] = Measure::find($measure->id);
            return view('admin.pages.measure.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, Measure $measure){
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
            $measures = Measure::find($measure->id);
            $measures->name = $request->name;
            $measures->price = $request->price;
            $measures->save();

            return redirect('/admin/master-data/measure')->withStatus('Berhasil memperbarui data tindakan.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(Measure $measure){
        try {
            Measure::find($measure->id)->delete();
            return redirect('/admin/master-data/measure')->withStatus('Berhasil menghapus data tindakan.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
