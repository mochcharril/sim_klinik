<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MeasurePatientDetail extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'measure_patient_details';
    protected $primaryKey = 'id';
}
