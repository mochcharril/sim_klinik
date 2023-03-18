<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class DoctorController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getDoctor'] = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'dokter');})->get();;
            
            return view('admin.pages.doctor.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.doctor.add');
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
                'email' => 'required|email',
                'password' => 'required|required_with:password_confirm|same:password_confirm',
                'password_confirm' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'email' => 'Format surel tidak benar.',
                'same' => 'Kata Sandi dan Konfirmasi Kata Sandi harus sama.'
            ],
            [
                'name' => 'Nama Dokter',
                'email' => 'Surel Dokter',
                'password' => 'Kata Sandi',
                'password_confirm' => 'Konfirmasi Kata Sandi',
            ],
        );
        try {
            $doctor = new User();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->email_verified_at = now();
            $doctor->password = bcrypt($request->password);
            $doctor->remember_token = \Str::random(60);
            $doctor->save();

            event(new Registered($doctor));
            $doctor->assignRole('dokter');

            return redirect('/admin/master-data/doctor')->withStatus('Berhasil menambah data akun dokter.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(User $user){
        try {
            $this->param['getDetailDoctor'] = User::find($user->id);
            return view('admin.pages.doctor.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, User $user){
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
            ],
            [
                'required' => ':attribute harus diisi.',
                'email' => 'Format surel tidak benar.',
            ],
            [
                'name' => 'Nama Dokter',
                'email' => 'Surel Dokter',
            ],
        );
        try {
            $doctor = User::find($user->id);
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->save();

            return redirect('/admin/master-data/doctor')->withStatus('Berhasil memperbarui data akun dokter.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(User $user){
        try {
            User::find($user->id)->delete();
            return redirect('/admin/master-data/doctor')->withStatus('Berhasil menghapus data akun dokter.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
