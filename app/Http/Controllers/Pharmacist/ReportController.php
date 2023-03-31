<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medicine;
use PDF;

class ReportController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:apoteker']);
    }

    public function listMedicine(){
        try {
            $this->param['getMedicine'] = Medicine::all();
            
            return view('pharmacist.pages.report.medicine-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
    public function printMedicine(){
        try {
            $this->param['getMedicine'] = Medicine::all();
            $pdf = PDF::loadview('pharmacist.pages.report.medicine-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function listMedicineIncoming(){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->get();
            
            return view('pharmacist.pages.report.medicine-incoming-list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function printMedicineIncoming(){
        try {
            $this->param['getMedicineIncoming'] = \DB::table('incoming_medicine_details')
                                                        ->select('incoming_medicines.code_im', 'users.name as pharmacist', 'incoming_medicines.date_income_medicine', 'medicines.name', 'incoming_medicine_details.stock_in', 'incoming_medicine_details.total')
                                                        ->join('incoming_medicines', 'incoming_medicine_details.incoming_medicine_id', 'incoming_medicines.id')
                                                        ->join('users', 'incoming_medicines.parmachist_id', 'users.id')
                                                        ->join('medicines', 'incoming_medicine_details.medicine_id', 'medicines.id')
                                                        ->get();
            $pdf = PDF::loadview('pharmacist.pages.report.medicine-incoming-print', $this->param)->setPaper('legal', 'landscape');
            return $pdf->stream('cetak-laporan-pdf-obat-masuk', array("Attachment" => false));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}
