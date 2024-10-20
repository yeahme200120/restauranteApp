<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorAppGlobal extends Model
{
    use HasFactory;
    protected $fillable = [
        'color',
        'id_empresa',
        'id_usuario',
    ];  
}
