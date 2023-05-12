<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Poly extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'polies';
    protected $primaryKey = 'id';

    public static function generateCodePL(){
        $lastCodePL = Poly::orderBy('id', 'desc')->first();
        if(!$lastCodePL){
            $codePL = 'PL-0001';
        } else {
            $getLastCodePL = $lastCodePL->code_pl;
            $lastNumber = substr($getLastCodePL, 4);
            $newNumber = $lastNumber+1;
            $codePL = 'PL-'.str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
        return $codePL;
    }
}
