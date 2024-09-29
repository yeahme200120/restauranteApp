<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_producto',
        'precio_compra',
        'precio_venta',
        'id_provedor',
        'cantidad',
        'stock',
        'iva',
        'id_empresa',
        'id_estatus_producto',
        'id_categoria',
        'unidad'
    ]; 
}
