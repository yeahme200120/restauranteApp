<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'rol_usuario',
        'id_empresa',
        'estatus',
    ]; 
}
