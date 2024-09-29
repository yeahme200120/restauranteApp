<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'id_area_almacen',
        'precio_unitario',
        'iva',
        'id_unidad',
        'cantidad',
        'stock',
        'id_empresa',
        'id_provedor',
        'estatus',
    ]; 
}
