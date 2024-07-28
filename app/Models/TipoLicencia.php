<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion_tipo_licencia',
        'estatus',
    ];  
}
