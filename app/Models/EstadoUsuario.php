<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado_usuario',
        'id_empresa',
        'estatus_estado_usuario',
    ]; 
}
