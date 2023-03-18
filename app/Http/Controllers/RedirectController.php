<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roleUser = \Auth::user()->roles()->pluck('name')[0];
        if($roleUser == 'admin'){
            return redirect('/dashboard-admin');
        } elseif ($roleUser == 'dokter'){
            return redirect('/dashboard-dokter');
        } elseif ($roleUser == 'perawat'){
            return redirect('/dashboard-perawat');
        } elseif ($roleUser == 'apoteker'){
            return redirect('/dashboard-apoteker');
        } elseif ($roleUser == 'admisi'){
            return redirect('/dashboard-admisi');
        } elseif ($roleUser == 'klinik'){
            return redirect('/dashboard-klinik');
        } else {
            return redirect('/logout');
        }
    }
}
