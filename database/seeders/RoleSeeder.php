<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'dokter']);
        Role::create(['name' => 'perawat']);
        Role::create(['name' => 'apoteker']);
        Role::create(['name' => 'admisi']);
        Role::create(['name' => 'klinik']);
    }
}
