<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_categoria_producto',
        'nombre',
        'clave',
        'precio_venta',
        'precio_venta2',
        'precio_venta3',
        'id_empresa',
        'tipo',
        'id_unidad_producto',
        'estatus',
    ]; 
}
