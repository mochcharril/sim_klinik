<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($admin));
        $admin->assignRole('admin');

        $dokter = User::create([
            'name' => 'dokter',
            'email' => 'dokter@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('dokter123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($dokter));
        $dokter->assignRole('dokter');

        $perawat = User::create([
            'name' => 'perawat',
            'email' => 'perawat@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('perawat123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($perawat));
        $perawat->assignRole('perawat');

        $apoteker = User::create([
            'name' => 'apoteker',
            'email' => 'apoteker@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('apoteker123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($apoteker));
        $apoteker->assignRole('apoteker');

        $admisi = User::create([
            'name' => 'admisi',
            'email' => 'admisi@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admisi123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($admisi));
        $admisi->assignRole('admisi');

        $klinik = User::create([
            'name' => 'klinik',
            'email' => 'klinik@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('klinik123'),
            'remember_token' => \Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        event(new Registered($klinik));
        $klinik->assignRole('klinik');
    }
}
