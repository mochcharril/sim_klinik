<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomingMedicine;
use App\Models\IncomingMedicineDetail;
use App\Models\Medicine;

class IncomingMedicineController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:apoteker']);
    }

    public function index(){
        try {
            // $this->param['getIncomingMedicine'] = IncomingMedicine::all();
            $this->param['getIncomingMedicine'] = \DB::table('incoming_medicines')
                                                    ->select('incoming_medicines.id', 'incoming_medicines.code_im', 'users.name as pharmacist_name', 'incoming_medicines.total', 'incoming_medicines.date_income_medicine', 'incoming_medicines.created_at', 'incoming_medicines.updated_at')
                                                    ->join('users', 'incoming_medicines.parmachist_id', '=', 'users.id')
                                                    ->orderBy('incoming_medicines.updated_at', 'desc')
                                                    ->get();
            
            return view('pharmacist.pages.incoming_medicine.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    
    public function add(){
        try {
            $this->param['getCodeIM'] = IncomingMedicine::generateCodeIM();
            $this->param['getMedicine'] = Medicine::all();

            return view('pharmacist.pages.incoming_medicine.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'code_im' => 'required',
                'date_income_medicine' => 'required',
                // 'medicine[]' => 'required|not_in:0',
                // 'price[]' => 'required',
                // 'stock[]' => 'required',
                // 'stock_in[]' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'not_in' => ':attribute harus dipilih.',
            ],
            [
                'code_im' => 'Kode Transaksi Obat Masuk',
                'date_income_medicine' => 'Tanggal Obat Masuk',
                // 'medicine[]' => 'Nama Obat',
                // 'price[]' => 'Harga Obat',
                // 'stock[]' => 'Stok Obat',
                // 'stock_in[]' => 'Stok Masuk Obat',
            ]
        );
        try {

            $lengthMedicine = count($request->get('stock_in'));

            $incomingMedicine = new IncomingMedicine();
            $incomingMedicine->code_im = $request->get('code_im');
            $incomingMedicine->parmachist_id = auth()->user()->id;

            $tempTotal = 0;
            for ($x=0; $x < $lengthMedicine; $x++) { 
                $tempSubTotal = (int)$request->get('price')[$x] * (int)$request->get('stock_in')[$x];
                $tempTotal+=$tempSubTotal;
            }
            $incomingMedicine->total = $tempTotal;
            $incomingMedicine->date_income_medicine = $request->get('date_income_medicine');
            $incomingMedicine->save();

            for ($y=0; $y < $lengthMedicine ; $y++) { 
                $incomingMedicineDetail = new IncomingMedicineDetail();
                $incomingMedicineDetail->incoming_medicine_id = $incomingMedicine->id;
                $incomingMedicineDetail->medicine_id = $request->get('medicine')[$y];
                $incomingMedicineDetail->stock_in = $request->get('stock_in')[$y];
                $incomingMedicineDetail->total = (int)$request->get('price')[$y] * (int)$request->get('stock_in')[$y];
                $incomingMedicineDetail->save();

                $updateMedicine = Medicine::find($request->get('medicine')[$y]);
                $updateMedicine->stock = $request->get('stock')[$y] + $request->get('stock_in')[$y];
                $updateMedicine->expired_date = $request->get('expired_date')[$y];
                $updateMedicine->save();
            }

            return redirect('/pharmacist/warehouse/incoming_medicine')->withStatus('Berhasil menambahkan data obat masuk.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function detail(IncomingMedicine $incoming_medicine){
        try {
            $this->param['getIncomingMedicine'] = \DB::table('incoming_medicines')
                                                    ->select('incoming_medicines.id', 'incoming_medicines.code_im', 'users.name', 'incoming_medicines.total', 'incoming_medicines.date_income_medicine')
                                                    ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                    ->where('incoming_medicines.id', $incoming_medicine->id)
                                                    ->first();

            $this->param['getIncomingMedicineDetail'] = \DB::table('incoming_medicine_details')
                                                            ->select('medicines.code_md', 'medicines.name', 'incoming_medicine_details.stock_in', 'medicines.stock', 'medicines.price', 'incoming_medicine_details.total')
                                                            ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                            ->where('incoming_medicine_details.incoming_medicine_id', $incoming_medicine->id)
                                                            ->get();

            return view('pharmacist.pages.incoming_medicine.detail', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function getMedicine(Medicine $medicine){
        try {
            $this->param['getMedicineDetail'] = Medicine::find($medicine->id);
            return response()->json($this->param['getMedicineDetail']);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
