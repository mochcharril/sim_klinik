<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Medicine extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'medicines';
    protected $primaryKey = 'id';

    public static function generateCodeMD(){
        $lastCodeMD = Medicine::orderBy('id', 'desc')->first();
        if(!$lastCodeMD){
            $codeMD = 'MD-0001';
        } else {
            $getLastCodeMD = $lastCodeMD->code_md;
            $lastNumber = substr($getLastCodeMD, 4);
            $newNumber = $lastNumber+1;
            $codeMD = 'MD-'.str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
        return $codeMD;
    }
}
