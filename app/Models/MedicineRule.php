<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MedicineRule extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'medicine_rules';
    protected $primaryKey = 'id';
}
