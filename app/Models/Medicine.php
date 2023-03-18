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
}
