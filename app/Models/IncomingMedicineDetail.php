<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class IncomingMedicineDetail extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'incoming_medicine_details';
    protected $primaryKey = 'id';
}
