<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class PharmacistController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getPharmacist'] = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'apoteker');})->get();;
            
            return view('admin.pages.pharmacist.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.pharmacist.add');
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
                'name' => 'Nama Apoteker',
                'email' => 'Surel Apoteker',
                'password' => 'Kata Sandi',
                'password_confirm' => 'Konfirmasi Kata Sandi',
            ],
        );
        try {
            $pharmacist = new User();
            $pharmacist->name = $request->name;
            $pharmacist->email = $request->email;
            $pharmacist->email_verified_at = now();
            $pharmacist->password = bcrypt($request->password);
            $pharmacist->remember_token = \Str::random(60);
            $pharmacist->save();

            event(new Registered($pharmacist));
            $pharmacist->assignRole('apoteker');

            return redirect('/admin/master-data/pharmacist')->withStatus('Berhasil menambah data akun apoteker.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(User $user){
        try {
            $this->param['getDetailPharmacist'] = User::find($user->id);
            return view('admin.pages.pharmacist.edit', $this->param);
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
                'name' => 'Nama Apoteker',
                'email' => 'Surel Apoteker',
            ],
        );
        try {
            $pharmacist = User::find($user->id);
            $pharmacist->name = $request->name;
            $pharmacist->email = $request->email;
            $pharmacist->save();

            return redirect('/admin/master-data/pharmacist')->withStatus('Berhasil memperbarui data akun apoteker.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(User $user){
        try {
            User::find($user->id)->delete();
            return redirect('/admin/master-data/pharmacist')->withStatus('Berhasil menghapus data akun apoteker.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
