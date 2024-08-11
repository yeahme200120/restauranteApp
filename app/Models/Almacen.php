<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_producto',
        'precio_compra',
        'precio_venta',
        'id_provedor',
        'stock',
        'id_estado',
        'id_empresa',
        'id_estatus_producto',
        'categoria',
        'unidad'

    ];   
}
