<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MeasurePatient extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'measure_patients';
    protected $primaryKey = 'id';

    public static function generateCodeMSP(){
        $lastCodeMSP = MeasurePatient::orderBy('id', 'desc')->first();
        if(!$lastCodeMSP){
            $codeMSP = 'MSP-0000001';
        } else {
            $getLastCodeMSP = $lastCodeMSP->code_msp;
            $lastNumber = substr($getLastCodeMSP, 7);
            $newNumber = $lastNumber+1;
            $codeMSP = 'MSP-'.str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }
        return $codeMSP;
    }
}
