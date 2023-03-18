<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class RecipeDetail extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'recipe_details';
    protected $primaryKey = 'id';
}
