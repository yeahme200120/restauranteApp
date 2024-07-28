<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEmpresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado_empresa',
        'estatus_estado_empresa',
    ];  
}
