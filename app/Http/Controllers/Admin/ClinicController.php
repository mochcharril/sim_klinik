<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class ClinicController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getClinic'] = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'klinik');})->get();;
            
            return view('admin.pages.clinic.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.clinic.add');
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
                'name' => 'Nama Ka Klinik',
                'email' => 'Surel Ka Klinik',
                'password' => 'Kata Sandi',
                'password_confirm' => 'Konfirmasi Kata Sandi',
            ],
        );
        try {
            $clinic = new User();
            $clinic->name = $request->name;
            $clinic->email = $request->email;
            $clinic->email_verified_at = now();
            $clinic->password = bcrypt($request->password);
            $clinic->remember_token = \Str::random(60);
            $clinic->save();

            event(new Registered($clinic));
            $clinic->assignRole('klinik');

            return redirect('/admin/master-data/clinic')->withStatus('Berhasil menambah data akun Ka Klinik.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(User $user){
        try {
            $this->param['getDetailClinic'] = User::find($user->id);
            return view('admin.pages.clinic.edit', $this->param);
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
                'name' => 'Nama Ka Klinik',
                'email' => 'Surel Ka Klinik',
            ],
        );
        try {
            $clinic = User::find($user->id);
            $clinic->name = $request->name;
            $clinic->email = $request->email;
            $clinic->save();

            return redirect('/admin/master-data/clinic')->withStatus('Berhasil memperbarui data akun Ka Klinik.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(User $user){
        try {
            User::find($user->id)->delete();
            return redirect('/admin/master-data/clinic')->withStatus('Berhasil menghapus data akun Ka Klinik.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
