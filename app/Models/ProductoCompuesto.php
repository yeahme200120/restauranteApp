<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_producto',
        'id_insumo',
        'cantidad_insumo',
        'id_usuario',
        'fecha_uso',
        'estatus'
    ]; 
}
