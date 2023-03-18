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
}
