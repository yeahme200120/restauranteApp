<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_provedor',
        'direccion',
        'correo',
        'id_categoria',
        'id_empresa',
        'nombre_empresa',
        'razon_social',
        'telefono',
        'id_Estatus_provedor'
    ];   
}
