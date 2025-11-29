<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Services\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string',
                'session_id' => 'nullable|string'
            ]);

            // 🔥 OBTENER EL USUARIO AUTENTICADO
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'reply' => 'Debes iniciar sesión para usar el chat.',
                    'suggestions' => [],
                ], 401);
            }

            $sessionId = $request->session_id ?? $this->generateSessionId();
            
            // 🔥 CORRECCIÓN: Buscar o crear conversación VINCULADA AL USUARIO
            $conversation = Conversation::firstOrCreate(
                [
                    'user_id' => $user->id,      // ✅ Vincula al usuario
                    'session_id' => $sessionId
                ],
                ['context' => ['current_step' => 'welcome']]
            );

            // Procesar TODOS los mensajes (incluyendo 'init') con processMessage
            $response = $this->chatService->processMessage($request->message, $conversation);

            // Si NO es 'init', guardar el mensaje del usuario
            if ($request->message !== 'init' && $request->message !== '') {
                $userDisplayMessage = $this->getUserDisplayMessage($request->message);
                $conversation->addUserMessage($userDisplayMessage, $request->message);
            }

            // Guardar respuesta del bot
            $conversation->addBotMessage($response['reply'], $response['suggestions'] ?? []);

            return response()->json([
                'reply' => $response['reply'],
                'suggestions' => $response['suggestions'] ?? [],
                'session_id' => $sessionId
            ]);

        } catch (\Exception $e) {
            Log::error('Chat error: ' . $e->getMessage());
            return response()->json([
                'reply' => 'Lo siento, hubo un error en el sistema. Por favor, intenta nuevamente.',
                'suggestions' => ['💬 Reintentar'],
                'session_id' => $sessionId ?? Str::uuid()->toString()
            ], 500);
        }
    }

    // Método para convertir opciones en respuestas naturales
    private function getUserDisplayMessage(string $option): string
    {
        $naturalResponses = [
            '😔 Triste' => 'Me siento triste hoy',
            '😞 Ansioso/a' => 'Estoy sintiendo ansiedad',
            '😌 Tranquilo/a' => 'Me siento tranquilo/a',
            '😕 No estoy seguro/a' => 'No estoy seguro de cómo me siento',
            '🎧 Canción suave' => 'Me gustaría escuchar una canción suave',
            '📚 Recomendación de libro' => 'Quiero una recomendación de libro',
            '🌬 Ejercicio de respiración' => 'Quiero hacer un ejercicio de respiración',
            '🌬 Técnica rápida de calma' => 'Necesito una técnica de calma',
            '🎧 Música relajante' => 'Pon música relajante',
            '🧘 Mini-relajación guiada' => 'Guíame en una relajación',
            '✨ Frase positiva' => 'Dame una frase positiva',
            '🎧 Música suave' => 'Música suave por favor',
            '🌿 Actividad tranquila' => 'Sugiere una actividad tranquila',
            '💭 Explorar emociones' => 'Ayúdame a explorar mis emociones',
            '✨ Frase de claridad' => 'Dame una frase de claridad',
            '🌬 Respiración suave' => 'Enséñame a respirar suave',
            '💬 Sí, tengo otra inquietud' => 'Sí, tengo otra inquietud',
            '👋 No, gracias' => 'No, gracias',
            '💬 Iniciar nueva conversación' => 'Quiero iniciar nueva conversación',
            '💬 Reintentar' => 'Reintentar',
            '🏠 Menú principal' => 'Volver al menú principal'
        ];

        return $naturalResponses[$option] ?? $option;
    }

    public function getConversationHistory($sessionId, Request $request)
    {
        try {
            // 🔥 OBTENER EL USUARIO AUTENTICADO
            $user = $request->user();
            
            if (!$user) {
                return response()->json(['messages' => []], 401);
            }

            // 🔥 CORRECCIÓN: Filtrar por usuario Y session_id
            $conversation = Conversation::with('messages')
                ->where('user_id', $user->id)      // ✅ Solo conversaciones del usuario
                ->where('session_id', $sessionId)
                ->first();

            if (!$conversation) {
                return response()->json(['messages' => []]);
            }

            $messages = $conversation->messages()
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function ($message) {
                    return [
                        'type' => $message->type,
                        'text' => $message->content,
                        'options' => $message->options,
                        'time' => $message->created_at->format('H:i'),
                        'selected_option' => $message->selected_option
                    ];
                });

            return response()->json(['messages' => $messages]);
        } catch (\Exception $e) {
            Log::error('History error: ' . $e->getMessage());
            return response()->json(['messages' => []], 500);
        }
    }

    private function generateSessionId(): string
    {
        return Str::uuid()->toString();
    }
}