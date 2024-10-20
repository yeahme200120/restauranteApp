<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadInsumo extends Model
{
    use HasFactory;
    protected $fillable = [
        'unidad',
        'id_empresa',
        'estatus',
    ];
}
