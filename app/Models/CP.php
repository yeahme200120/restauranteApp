<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CP extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'pais',
        'estado',
        'municipio',
        'ciudad'
    ];
}
