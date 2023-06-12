<?php

namespace App\Http\Controllers\Admition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Poly;

use PDF;

class PatientController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admisi']);
    }

    public function index(){
        try {
            $this->param['getPatient'] = Patient::where('is_retention', 'no')->orderBy('updated_at', 'desc')->get();
            $this->param['getPatientRetention'] = Patient::where('is_retention', 'yes')->orderBy('updated_at', 'desc')->get();

            return view('admition.pages.patient.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            $this->param['getCodeRM'] = Patient::generateCodeRM();
            $this->param['getPoly'] = Poly::all();

            return view('admition.pages.patient.add', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function store(Request $request){
        if ($request->register_as == 'as_mhs') {
            $this->validate($request, 
                [
                    'nim_nip' => 'required',
                ],
                [
                    'required' => ':attribute harus diisi.',
                ],
                [
                    'nim_nip' => 'NIM Mahasiswa',
                ]
            );
        } elseif ($request->register_as == 'as_kry') {
            $this->validate($request, 
                [
                    'nim_nip_karyawan' => 'required',
                ],
                [
                    'required' => ':attribute harus diisi.',
                ],
                [
                    'nim_nip_karyawan' => 'NIP Karyawan',
                ]
            );
        } elseif ($request->register_as == 'as_klg') {
            $this->validate($request, 
                [
                    'nim_nip_keluarga' => 'required',
                    'family_from' => 'required',
                    'family_as' => 'required',
                ],
                [
                    'required' => ':attribute harus diisi.',
                ],
                [
                    'nim_nip_keluarga' => 'NIP Karyawan',
                    'family_from' => 'Nama Karyawan',
                    'family_as' => 'Hubungan Keluarga',
                ]
            );
        }

        $this->validate($request,
            [
                'code_rm' => 'required',
                'name' => 'required',
                'nik' => 'required|min:16|max:16|unique:patients',
                'gender' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
            ],
            [
                'unique' => 'NIK sudah terdaftar mohon dicari di kolom pencarian data pasien',
                'required' => ':attribute harus diisi.',
                'nik.min' => ':attribute harus 16 digit',
                'nik.max' => ':attribute harus 16 digit',
            ],
            [
                'code_rm' => 'Kode RM',
                'name' => 'Nama Pasien',
                'nik' => 'NIK Pasien',
                'gender' => 'Jenis Kelamin',
                'place_of_birth' => 'Tempat Lahir',
                'date_of_birth' => 'Tanggal Lahir',
                'address' => 'Alamat',
                'phone_number' => 'Nomor Telepon',
            ],
        );
        try {
            $patient = new Patient();
            $patient->code_rm = $request->code_rm;
            $patient->name = $request->name;
            $patient->nik = $request->nik;
            $patient->gender = $request->gender;
            $patient->place_of_birth = $request->place_of_birth;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->address = $request->address;
            $patient->phone_number = $request->phone_number;

            if($request->insurance_type == null || $request->insurance_type == ''){
                $patient->insurance_type = '-';
            } else {
                $patient->insurance_type = $request->insurance_type;
            }

            if($request->insurance_number == null || $request->insurance_number == ''){
                $patient->insurance_number = '-';
            } else {
                $patient->insurance_number = $request->insurance_number;
            }

            $patient->is_retention = 'no';

            if ($request->register_as == 'as_umum'){
                $patient->register_as = 'Umum';
                $patient->nim_nip = '-';
                $patient->family_from = '-';
                $patient->family_as = '-';
            } elseif ($request->register_as == 'as_mhs'){
                $patient->register_as = 'Mahasiswa';
                $patient->nim_nip = $request->nim_nip;
                $patient->family_from = '-';
                $patient->family_as = '-';
            } elseif ($request->register_as == 'as_kry'){
                $patient->register_as = 'Karyawan';
                $patient->nim_nip = $request->nim_nip_karyawan;
                $patient->family_from = '-';
                $patient->family_as = '-';
            } elseif ($request->register_as == 'as_klg'){
                $patient->register_as = 'Keluarga Karyawan';
                $patient->nim_nip = $request->nim_nip_keluarga;
                $patient->family_from = $request->family_from;
                $patient->family_as = $request->family_as;
            }

            $patient->save();

            return redirect('/admition/master-data/patient')->withStatus('Berhasil menambah data pasien.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(Patient $patient){
        try {
            $this->param['getPoly'] = Poly::all();
            $this->param['getDetailPatient'] = Patient::find($patient->id);
            return view('admition.pages.patient.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, Patient $patient){
        $this->validate($request,
            [
                'code_rm' => 'required',
                'name' => 'required',
                'nik' => 'required|min:16|max:16',
                'gender' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'nik.min' => ':attribute harus 16 digit',
                'nik.max' => ':attribute harus 16 digit',
            ],
            [
                'code_rm' => 'Kode RM',
                'name' => 'Nama Pasien',
                'nik' => 'NIK Pasien',
                'gender' => 'Jenis Kelamin',
                'place_of_birth' => 'Tempat Lahir',
                'date_of_birth' => 'Tanggal Lahir',
                'address' => 'Alamat',
                'phone_number' => 'Nomor Telepon',
            ],
        );
        try {
            $patient = Patient::find($patient->id);
            $patient->code_rm = $request->code_rm;
            $patient->name = $request->name;
            $patient->nik = $request->nik;
            $patient->gender = $request->gender;
            $patient->place_of_birth = $request->place_of_birth;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->address = $request->address;
            $patient->phone_number = $request->phone_number;

            if($request->insurance_type == null || $request->insurance_type == ''){
                $patient->insurance_type = '-';
            } else {
                $patient->insurance_type = $request->insurance_type;
            }

            if($request->insurance_number == null || $request->insurance_number == ''){
                $patient->insurance_number = '-';
            } else {
                $patient->insurance_number = $request->insurance_number;
            }

            $patient->is_retention = $request->is_retention;
            $patient->save();

            return redirect('/admition/master-data/patient')->withStatus('Berhasil memperbarui data pasien.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(Patient $patient){
        try {
            Patient::find($patient->id)->delete();
            return redirect('/admition/master-data/patient')->withStatus('Berhasil menghapus data pasien.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function print(Patient $patient){
        try {
            $this->param['getDetailPatient'] = Patient::find($patient->id);
            $pdf = PDF::loadview('admition.pages.patient.print', $this->param);
            // return $pdf->download('cetak-pdf-pasien');
            return $pdf->stream('KIB-Pasien', array("Attachment" => false));

        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
