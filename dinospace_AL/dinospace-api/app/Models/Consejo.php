<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    // Define los campos que pueden ser llenados masivamente
    protected $fillable = ['titulo', 'descripcion'];
}