<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetoDiario extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla en la base de datos
    protected $table = 'retos_diarios';

    // Define los campos que pueden ser llenados masivamente
    protected $fillable = [
            'categoria',
            'titulo',
            'descripcion',
            'duracion',
            'dificultad',
            'objetivo',
            'beneficios',
            'pasos',
            'activo'
        ];

}