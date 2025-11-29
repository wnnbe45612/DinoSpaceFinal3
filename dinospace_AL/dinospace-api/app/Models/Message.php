<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    // Define los campos que pueden ser llenados masivamente
    protected $fillable = [
        'conversation_id', 
        'type', 
        'content', 
        'options', 
        'selected_option'
    ];
    
    // Convierte el campo options de JSON a array automáticamente
    protected $casts = [
        'options' => 'array',
    ];

    // Define la relación con el modelo Conversation (un mensaje pertenece a una conversación)
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}