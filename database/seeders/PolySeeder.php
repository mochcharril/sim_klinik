<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poly;

class PolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poly = new Poly();
        $poly->code_pl = 'PL-0001';
        $poly->name = 'Poli Umum';
        $poly->save();

        $poly = new Poly();
        $poly->code_pl = 'PL-0002';
        $poly->name = 'Poli Gigi';
        $poly->save();

        $poly = new Poly();
        $poly->code_pl = 'PL-0003';
        $poly->name = 'Poli KIA (Kesehatan Ibu dan Anak)';
        $poly->save();
    }
}
