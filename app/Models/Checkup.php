<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Checkup extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'checkups';
    protected $primaryKey = 'id';

    public static function generateCodeCU(){
        $lastCodeCU = Checkup::orderBy('id', 'desc')->first();
        if(!$lastCodeCU){
            $codeCU = 'CU-0000001';
        } else {
            $getLastCodeCU = $lastCodeCU->code_cu;
            $lastNumber = substr($getLastCodeCU, 7);
            $newNumber = $lastNumber+1;
            $codeCU = 'CU-'.str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }
        return $codeCU;
    }
}
