<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'ciudad',
        'codigo_postal',
        'domicilio_fiscal',
        'giro',
        'nombre_empresa',
        'pais',
        'razon_social',
        'RFC',
        'estatus_empresa',
    ];  
}
