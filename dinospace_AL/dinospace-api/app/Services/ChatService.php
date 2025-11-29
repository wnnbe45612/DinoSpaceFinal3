<?php
// app/Services/ChatService.php
namespace App\Services;

use App\Models\Conversation;
use Illuminate\Support\Facades\Log;

class ChatService
{
    private $conversationFlows;

    public function __construct()
    {
        $this->conversationFlows = $this->initializeFlows();
    }

    private function initializeFlows()
    {
        $welcomeMessage = '¡Hola! Soy DinoBot 🦖💬 ¿Cómo te sientes hoy?';
        $welcomeOptions = ['😔 Triste', '😞 Ansioso/a', '😌 Tranquilo/a', '😕 No estoy seguro/a'];

        $flows = [
            'welcome' => [
                'message' => $welcomeMessage,
                'options' => $welcomeOptions,
                'next_step' => 'handle_feelings'
            ],

            'handle_feelings' => [
                '😔 Triste' => [
                    'response' => $this->getRandomResponse('triste'),
                    'suggestions' => ['🎧 Canción suave', '📚 Recomendación de libro', '🌬 Ejercicio de respiración'],
                    'next_step' => 'handle_triste_options'
                ],
                '😞 Ansioso/a' => [
                    'response' => $this->getRandomResponse('ansioso'),
                    'suggestions' => ['🌬 Técnica rápida de calma', '🎧 Música relajante', '🧘 Mini-relajación guiada'],
                    'next_step' => 'handle_ansioso_options'
                ],
                '😌 Tranquilo/a' => [
                    'response' => $this->getRandomResponse('tranquilo'),
                    'suggestions' => ['✨ Frase positiva', '🎧 Música suave', '🌿 Actividad tranquila'],
                    'next_step' => 'handle_tranquilo_options'
                ],
                '😕 No estoy seguro/a' => [
                    'response' => $this->getRandomResponse('duda'),
                    'suggestions' => ['💭 Explorar emociones', '✨ Frase de claridad', '🌬 Respiración suave'],
                    'next_step' => 'handle_duda_options'
                ]
            ],

            'handle_triste_options' => [
                '🎧 Canción suave' => [
                    'response' => $this->getRandomSong('triste') . "\n\n💛 Espero que esta canción te dé un momento de calma.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '📚 Recomendación de libro' => [
                    'response' => $this->getRandomBook() . "\n\n💙 Quizá alguno de estos libros te acompañe en un momento difícil.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🌬 Ejercicio de respiración' => [
                    'response' => $this->getRandomBreathing('triste') . "\n\n💛 Respiraste muy bien. Estoy aquí para ti.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ]
            ],

            'handle_ansioso_options' => [
                '🌬 Técnica rápida de calma' => [
                    'response' => $this->getRandomCalmTechnique() . "\n\n💛 Lo hiciste muy bien. Aquí estoy contigo.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🎧 Música relajante' => [
                    'response' => $this->getRandomSong('ansioso') . "\n\n💙 Escucha esto con calma. Respira.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🧘 Mini-relajación guiada' => [
                    'response' => $this->getRandomRelaxation() . "\n\n💛 Espero que te sientas un poquito más liviano/a.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ]
            ],

            'handle_tranquilo_options' => [
                '✨ Frase positiva' => [
                    'response' => $this->getRandomQuote('positiva') . "\n\n💛 Que esta frase te acompañe.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🎧 Música suave' => [
                    'response' => $this->getRandomSong('tranquilo') . "\n\n💛 Disfruta de esta melodía.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🌿 Actividad tranquila' => [
                    'response' => $this->getRandomActivity() . "\n\n💛 Espero que sigas sintiendo calma.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ]
            ],

            'handle_duda_options' => [
                '💭 Explorar emociones' => [
                    'response' => $this->getRandomExploration() . "\n\n💛 Gracias por darte un momento para escucharte.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '✨ Frase de claridad' => [
                    'response' => $this->getRandomQuote('claridad') . "\n\n💛 Que esta frase te traiga paz.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ],
                '🌬 Respiración suave' => [
                    'response' => $this->getRandomBreathing('duda') . "\n\n💛 Respiraste muy bien.",
                    'suggestions' => ['💬 Sí, tengo otra inquietud', '👋 No, gracias'],
                    'next_step' => 'handle_final_question'
                ]
            ],

            'handle_final_question' => [
                '💬 Sí, tengo otra inquietud' => [
                    'response' => '¡Perfecto! ¿Sobre qué te gustaría hablar?',
                    'suggestions' => $welcomeOptions,
                    'next_step' => 'handle_feelings'
                ],
                '👋 No, gracias' => [
                    'response' => 'Gracias por conversar conmigo 💛 Cuando quieras volver, estaré aquí para acompañarte.',
                    'suggestions' => ['💬 Iniciar nueva conversación'],
                    'next_step' => 'handle_new_conversation'
                ]
            ],

            'handle_new_conversation' => [
                '💬 Iniciar nueva conversación' => [
                    'response' => $welcomeMessage,
                    'suggestions' => $welcomeOptions,
                    'next_step' => 'handle_feelings'
                ]
            ]
        ];

        return $flows;
    }

    private function getRandomResponse($type)
    {
        $responses = [
            'triste' => [
                "Lo siento, sé que la tristeza puede ser muy pesada. ¿Quieres probar algo que podría reconfortarte?",
                "A veces estar triste es parte del proceso, pero no estás solo/a. ¿Quieres intentar algo que te ayude a sentirte un poquito mejor?",
                "Gracias por compartir cómo te sientes. Vamos a buscar algo que te dé un poquitito de calma."
            ],
            'ansioso' => [
                "La ansiedad puede ser fuerte, pero puedes recuperar la calma poco a poco. Vamos paso a paso.",
                "Respira. Estás a salvo. Vamos a ayudarte a sentir un poco más de tranquilidad.",
                "Gracias por compartirlo. La ansiedad no te define. Vamos a probar algo que pueda ayudarte."
            ],
            'tranquilo' => [
                "¡Me alegra saberlo! Aprovechemos este buen momento.",
                "Eso suena muy bien. Vamos a mantener esa linda energía.",
                "¡Qué bonito que te sientas así! Sigamos cuidando esa calma."
            ],
            'duda' => [
                "Está bien no saber exactamente cómo te sientes. Vamos a explorarlo juntos.",
                "A veces sentir confusión es normal. Lo importante es darte espacio.",
                "No tener claridad también es una emoción válida. Vamos a ayudarte a orientarte."
            ]
        ];

        return $responses[$type][array_rand($responses[$type])];
    }

    private function getRandomSong($type)
    {
        $songs = [
            'triste' => [
                "🎵 Recomendación: 'Stay With Me' – Sam Smith",
                "🎵 Recomendación: 'Photograph' – Ed Sheeran", 
                "🎵 Recomendación: 'Fix You' – Coldplay"
            ],
            'ansioso' => [
                "🎵 Recomendación: 'Weightless' – Marconi Union",
                "🎵 Recomendación: 'River Flows in You' – Yiruma",
                "🎵 Recomendación: 'Bloom' – ODESZA"
            ],
            'tranquilo' => [
                "🎵 Recomendación: 'Here Comes the Sun' – The Beatles",
                "🎵 Recomendación: 'Holocene' – Bon Iver",
                "🎵 Recomendación: 'Ocean Eyes' – Billie Eilish"
            ]
        ];

        return $songs[$type][array_rand($songs[$type])];
    }

    private function getRandomBook()
    {
        $books = [
            "📖 Recomendación: 'El Principito' – Antoine de Saint-Exupéry",
            "📖 Recomendación: 'La razón de estar contigo' – W. Bruce Cameron", 
            "📖 Recomendación: 'El monje que vendió su Ferrari' – Robin Sharma"
        ];

        return $books[array_rand($books)];
    }

    private function getRandomBreathing($type)
    {
        $breathing = [
            'triste' => [
                "🌬 Ejercicio: Respira 4 segundos… retén 4… exhala 4. Hazlo 3 veces.",
                "🌬 Ejercicio: Inhala profundo… exhala despacio… repite 5 veces.",
                "🌬 Ejercicio: Respira como si inflaras un globo. Exhala lento."
            ],
            'duda' => [
                "🌬 Ejercicio: Inhala lento… exhala más lento.",
                "🌬 Ejercicio: Respira como si soplaras una vela sin apagarla.",
                "🌬 Ejercicio: Inhala 3, exhala 5. Muy bien."
            ]
        ];

        return $breathing[$type][array_rand($breathing[$type])];
    }

    private function getRandomCalmTechnique()
    {
        $techniques = [
            "🫁 Técnica: Inhala 4 segundos, exhala 6. Repite 5 veces.",
            "🫁 Técnica: Coloca una mano en tu pecho. Respira suave 3 veces.",
            "🫁 Técnica: Mira un objeto y describe su color mentalmente."
        ];

        return $techniques[array_rand($techniques)];
    }

    private function getRandomRelaxation()
    {
        $relaxations = [
            "🧘 Relajación: Relaja los hombros… relaja la mandíbula… respira.",
            "🧘 Relajación: Cierra los ojos y piensa en un lugar tranquilo.",
            "🧘 Relajación: Imagina que la ansiedad sale con cada exhalación."
        ];

        return $relaxations[array_rand($relaxations)];
    }

    private function getRandomQuote($type)
    {
        $quotes = [
            'positiva' => [
                "✨ Frase: 'Estás exactamente donde debes estar.'",
                "✨ Frase: 'La calma empieza cuando te escuchas.'", 
                "✨ Frase: 'Lo que hoy es paz, mañana será fuerza.'"
            ],
            'claridad' => [
                "✨ Frase: 'No tienes que resolverlo todo hoy.'",
                "✨ Frase: 'Tu mente se aclara cuando descansa.'",
                "✨ Frase: 'La calma trae respuestas.'"
            ]
        ];

        return $quotes[$type][array_rand($quotes[$type])];
    }

    private function getRandomActivity()
    {
        $activities = [
            "🌿 Actividad: Estírate suavemente por 10 segundos.",
            "🌿 Actividad: Toma un vaso de agua despacio.",
            "🌿 Actividad: Mira por la ventana 20 segundos."
        ];

        return $activities[array_rand($activities)];
    }

    private function getRandomExploration()
    {
        $explorations = [
            "💭 Exploración: Quizá estás un poco cansado/a.",
            "💭 Exploración: Tal vez sientes mezcla de cosas.",
            "💭 Exploración: Puede que necesites una pausa mental."
        ];

        return $explorations[array_rand($explorations)];
    }

    public function processMessage(string $userMessage, Conversation $conversation): array
    {
        try {
            Log::info("=== ChatService::processMessage ===");
            Log::info("Mensaje: '{$userMessage}'");
            
            $context = $conversation->context ?? [];
            $currentStep = $context['current_step'] ?? 'welcome';
            
            Log::info("Paso actual: {$currentStep}");

            // CASO 1: Mensaje de inicio
            if ($userMessage === 'init') {
                Log::info("✅ Mensaje 'init' recibido");
                $welcome = $this->conversationFlows['welcome'];
                
                // Guardar el próximo paso ANTES de retornar
                $conversation->context = ['current_step' => $welcome['next_step']];
                $conversation->save();
                
                Log::info("✅ Contexto actualizado a: {$welcome['next_step']}");
                
                return [
                    'reply' => $welcome['message'],
                    'suggestions' => $welcome['options']
                ];
            }

            // CASO 2: Verificar que el paso existe
            if (!isset($this->conversationFlows[$currentStep])) {
                Log::warning("⚠️ Paso desconocido: {$currentStep}, reseteando");
                $welcome = $this->conversationFlows['welcome'];
                
                $conversation->context = ['current_step' => $welcome['next_step']];
                $conversation->save();
                
                return [
                    'reply' => $welcome['message'],
                    'suggestions' => $welcome['options']
                ];
            }

            // CASO 3: Buscar la respuesta en el paso actual
            $currentFlow = $this->conversationFlows[$currentStep];
            
            Log::info("Buscando '{$userMessage}' en paso '{$currentStep}'");
            Log::info("Opciones disponibles: " . implode(', ', array_keys($currentFlow)));

            if (isset($currentFlow[$userMessage])) {
                Log::info("✅ Opción encontrada!");
                $response = $currentFlow[$userMessage];
                
                // Guardar el próximo paso ANTES de retornar
                $conversation->context = ['current_step' => $response['next_step']];
                $conversation->save();
                
                Log::info("✅ Contexto actualizado a: {$response['next_step']}");
                
                return [
                    'reply' => $response['response'],
                    'suggestions' => $response['suggestions'] ?? []
                ];
            }

            // CASO 4: Opción no encontrada
            Log::warning("❌ Opción '{$userMessage}' NO encontrada en '{$currentStep}'");
            $welcome = $this->conversationFlows['welcome'];
            
            $conversation->context = ['current_step' => $welcome['next_step']];
            $conversation->save();
            
            return [
                'reply' => "No entendí tu respuesta. " . $welcome['message'],
                'suggestions' => $welcome['options']
            ];

        } catch (\Exception $e) {
            Log::error("🚨 Error en ChatService: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return [
                'reply' => 'Lo siento, hubo un error. Intenta nuevamente.',
                'suggestions' => ['💬 Reintentar']
            ];
        }
    }

    public function getWelcomeMessage(): array
    {
        return [
            'reply' => $this->conversationFlows['welcome']['message'],
            'suggestions' => $this->conversationFlows['welcome']['options']
        ];
    }
}