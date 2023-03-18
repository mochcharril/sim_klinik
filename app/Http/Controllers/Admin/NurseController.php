<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class NurseController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getNurse'] = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'perawat');})->get();;
            
            return view('admin.pages.nurse.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.nurse.add');
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
                'name' => 'Nama Perawat',
                'email' => 'Surel Perawat',
                'password' => 'Kata Sandi',
                'password_confirm' => 'Konfirmasi Kata Sandi',
            ],
        );
        try {
            $nurse = new User();
            $nurse->name = $request->name;
            $nurse->email = $request->email;
            $nurse->email_verified_at = now();
            $nurse->password = bcrypt($request->password);
            $nurse->remember_token = \Str::random(60);
            $nurse->save();

            event(new Registered($nurse));
            $nurse->assignRole('perawat');

            return redirect('/admin/master-data/nurse')->withStatus('Berhasil menambah data akun perawat.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(User $user){
        try {
            $this->param['getDetailNurse'] = User::find($user->id);
            return view('admin.pages.nurse.edit', $this->param);
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
                'name' => 'Nama Perawat',
                'email' => 'Surel Perawat',
            ],
        );
        try {
            $nurse = User::find($user->id);
            $nurse->name = $request->name;
            $nurse->email = $request->email;
            $nurse->save();

            return redirect('/admin/master-data/nurse')->withStatus('Berhasil memperbarui data akun perawat.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(User $user){
        try {
            User::find($user->id)->delete();
            return redirect('/admin/master-data/nurse')->withStatus('Berhasil menghapus data akun perawat.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
