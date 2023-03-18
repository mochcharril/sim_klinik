<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class PaymentDetail extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'payment_details';
    protected $primaryKey = 'id';
}
