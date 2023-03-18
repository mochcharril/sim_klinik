<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'patients';
    protected $primaryKey = 'id';

    public static function generateCodeRM(){
        $lastCodeRM = Patient::orderBy('id', 'desc')->first();
        if(!$lastCodeRM){
            $codeRM = 'RM-0001';
        } else {
            $getLastCodeRM = $lastCodeRM->code_rm;
            $lastNumber = substr($getLastCodeRM, 4);
            $newNumber = $lastNumber+1;
            $codeRM = 'RM-'.str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
        return $codeRM;
    }
}
