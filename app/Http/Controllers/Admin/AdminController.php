<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class AdminController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            $this->param['getAdmin'] = User::whereHas('roles', function($thisRole){$thisRole->where('name', 'admin');})->get();;
            
            return view('admin.pages.admin.list', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function add(){
        try {
            return view('admin.pages.admin.add');
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
                'name' => 'Nama Admin',
                'email' => 'Surel Admin',
                'password' => 'Kata Sandi',
                'password_confirm' => 'Konfirmasi Kata Sandi',
            ],
        );
        try {
            $admin = new User();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->email_verified_at = now();
            $admin->password = bcrypt($request->password);
            $admin->remember_token = \Str::random(60);
            $admin->save();

            event(new Registered($admin));
            $admin->assignRole('admin');

            return redirect('/admin/master-data/admin')->withStatus('Berhasil menambah data akun admin.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function edit(User $user){
        try {
            $this->param['getDetailAdmin'] = User::find($user->id);
            return view('admin.pages.admin.edit', $this->param);
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
                'name' => 'Nama Admin',
                'email' => 'Surel Admin',
            ],
        );
        try {
            $admin = User::find($user->id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->save();

            return redirect('/admin/master-data/admin')->withStatus('Berhasil memperbarui data akun admin.');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function drop(User $user){
        try {
            User::find($user->id)->delete();
            return redirect('/admin/master-data/admin')->withStatus('Berhasil menghapus data akun admin.');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
