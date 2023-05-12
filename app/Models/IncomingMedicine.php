<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class IncomingMedicine extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'incoming_medicines';
    protected $primaryKey = 'id';

    public static function generateCodeIM(){
        $lastCodeIM = IncomingMedicine::orderBy('id', 'desc')->first();
        if(!$lastCodeIM){
            $codeIM = 'TRNSIM-0001';
        } else {
            $getLastCodeIM = $lastCodeIM->code_im;
            $lastNumber = substr($getLastCodeIM, 7);
            $newNumber = $lastNumber+1;
            $codeIM = 'TRNSIM-'.str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
        return $codeIM;
    }
}
