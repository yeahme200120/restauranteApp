<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaAlmacen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_area',
        'id_empresa',
        'estatus_area',
    ]; 
}
