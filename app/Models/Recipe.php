<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Recipe extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'recipes';
    protected $primaryKey = 'id';

    public static function generateCodeRP(){
        $lastCodeRP = Recipe::orderBy('id', 'desc')->first();
        if(!$lastCodeRP){
            $codeRP = 'RP-0000001';
        } else {
            $getLastCodeRP = $lastCodeRP->code_rp;
            $lastNumber = substr($getLastCodeRP, 7);
            $newNumber = $lastNumber+1;
            $codeRP = 'RP-'.str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        }
        return $codeRP;
    }
}
