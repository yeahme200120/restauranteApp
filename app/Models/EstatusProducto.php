<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusProducto extends Model
{
    use HasFactory;
    protected $fillable = [
        'estatus_producto',
    ];   
}
