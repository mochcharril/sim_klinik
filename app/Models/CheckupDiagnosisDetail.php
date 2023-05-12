<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CheckupDiagnosisDetail extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'checkup_diagnosis_others';
    protected $primaryKey = 'id';
}
