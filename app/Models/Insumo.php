<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'id_categoria_insumo',
        'clave',
        'id_unidad',
        'stock',
        'cantidad',
        'id_empresa',
        'tipo',
        'estatus',
    ]; 
}
