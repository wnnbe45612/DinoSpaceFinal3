<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversation extends Model
{
    // Define los campos que pueden ser llenados masivamente
    protected $fillable = ['user_id', 'session_id', 'context'];
    
    // Convierte el campo context de JSON a array automáticamente
    protected $casts = [
        'context' => 'array',
    ];

    // Define la relación con el modelo User (una conversación pertenece a un usuario)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define la relación con el modelo Message (una conversación tiene muchos mensajes)
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    // Crea un nuevo mensaje de usuario en la conversación
    public function addUserMessage(string $content, ?string $selectedOption = null): Message
    {
        return $this->messages()->create([
            'type' => 'user',
            'content' => $content,
            'selected_option' => $selectedOption,
        ]);
    }

    // Crea un nuevo mensaje del bot en la conversación
    public function addBotMessage(string $content, array $options = []): Message
    {
        return $this->messages()->create([
            'type' => 'bot',
            'content' => $content,
            'options' => $options,
        ]);
    }
}