<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // Define los campos que pueden ser llenados masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
        'edad',
        'genero',
        'ciclo',
        'estado_emocional',
        'horas_sueno',
        'actividad',
        'motivacion',
    ];

    // Oculta campos sensibles en las respuestas JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define las conversiones de tipos para los campos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'edad' => 'integer',
        ];
    }

    // Define la relación con el modelo Conversation (un usuario tiene muchas conversaciones)
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }
}