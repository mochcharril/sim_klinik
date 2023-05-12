<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MedicalResume extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'medical_resumes';
    protected $primaryKey = 'id';
}
