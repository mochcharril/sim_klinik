<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Payment extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'payments';
    protected $primaryKey = 'id';

    public static function generateCodePY(){
        $lastCodePY = Payment::orderBy('id', 'desc')->first();
        if(!$lastCodePY){
            $codePY = 'PY-0000001';
        } else {
            $getLastCodePY = $lastCodePY->code_py;
            $lastNumber = substr($getLastCodePY, 7);
            $newNumber = $lastNumber+1;
            $codePY = 'PY-'.str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }
        return $codePY;
    }
}
