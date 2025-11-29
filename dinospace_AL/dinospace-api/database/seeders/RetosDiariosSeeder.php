<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RetoDiario;

class RetosDiariosSeeder extends Seeder
{
    public function run()
    {
        $retos = [
            // CONSEJOS PRÁCTICOS (10)
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Técnica Pomodoro',
                'descripcion' => 'Estudia usando la técnica Pomodoro: 25 minutos de estudio, 5 minutos de descanso',
                'duracion' => '25 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Maximizar la concentración mediante intervalos de estudio enfocados',
                'beneficios' => 'Mejora del enfoque, reducción de la fatiga mental y mayor productividad',
                'pasos' => '- Paso 1: Elige una tarea específica a realizar - Paso 2: Configura un temporizador por 25 minutos - Paso 3: Toma un descanso de 5 minutos y repite'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Mapa mental',
                'descripcion' => 'Crea un mapa mental sobre un tema que estés estudiando',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Organizar visualmente la información para mejor comprensión',
                'beneficios' => 'Memoria visual fortalecida, conexiones entre conceptos más claras',
                'pasos' => '- Paso 1: Coloca el tema central en el medio - Paso 2: Agrega ramas con ideas principales - Paso 3: Desarrolla sub-ramas con detalles específicos'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Resumen ejecutivo',
                'descripcion' => 'Haz un resumen de máximo una página sobre un tema complejo',
                'duracion' => '45 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Sintetizar información compleja en conceptos clave comprensibles',
                'beneficios' => 'Capacidad de síntesis mejorada, identificación de ideas principales',
                'pasos' => '- Paso 1: Identifica las 3-5 ideas más importantes - Paso 2: Elimina información redundante - Paso 3: Redacta de forma clara y concisa'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Flashcards digitales',
                'descripcion' => 'Crea 10 flashcards para repasar conceptos clave',
                'duracion' => '20 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Fortalecer la memoria mediante repaso activo de conceptos',
                'beneficios' => 'Memorización más efectiva, repaso rápido y portátil',
                'pasos' => '- Paso 1: Selecciona 10 conceptos importantes - Paso 2: Crea preguntas y respuestas - Paso 3: Organiza por categorías de dificultad'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Estudio activo',
                'descripcion' => 'Explica el tema en voz alta como si enseñaras a alguien',
                'duracion' => '30 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Identificar vacíos en el entendimiento mediante la explicación',
                'beneficios' => 'Comprensión más profunda, detección de puntos débiles',
                'pasos' => '- Paso 1: Prepara los conceptos a explicar - Paso 2: Explica como si enseñaras a un principiante - Paso 3: Toma nota de los puntos difíciles'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Planificación semanal',
                'descripcion' => 'Planifica tu semana de estudio con objetivos específicos',
                'duracion' => '15 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Organizar el tiempo de estudio para mayor eficiencia',
                'beneficios' => 'Reducción del estrés, mejor distribución del tiempo',
                'pasos' => '- Paso 1: Lista todas las materias/temas - Paso 2: Asigna tiempos realistas - Paso 3: Incluye espacios para imprevistos'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Autoexamen',
                'descripcion' => 'Crea tu propio examen con 10 preguntas',
                'duracion' => '40 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Evaluar el nivel de comprensión mediante autoevaluación',
                'beneficios' => 'Detección de áreas débiles, preparación para exámenes reales',
                'pasos' => '- Paso 1: Diseña preguntas de diferente dificultad - Paso 2: Incluye diversos formatos - Paso 3: Responde y califica objetivamente'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Estudio en grupo virtual',
                'descripcion' => 'Organiza una sesión de estudio por videollamada',
                'duracion' => '1 hora',
                'dificultad' => 'Media',
                'objetivo' => 'Aprovechar el aprendizaje colaborativo a distancia',
                'beneficios' => 'Perspectivas múltiples, apoyo mutuo, responsabilidad compartida',
                'pasos' => '- Paso 1: Coordina horario y plataforma - Paso 2: Define agenda y objetivos - Paso 3: Asigna roles y tiempos'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Técnica Feynman',
                'descripcion' => 'Explica un concepto complejo en términos simples',
                'duracion' => '35 minutos',
                'dificultad' => 'Difícil',
                'objetivo' => 'Demostrar dominio completo de un concepto complejo',
                'beneficios' => 'Comprensión profunda, capacidad de simplificar lo complejo',
                'pasos' => '- Paso 1: Elige un concepto difícil - Paso 2: Explícalo en lenguaje simple - Paso 3: Identifica y supera los puntos confusos'
            ],
            [
                'categoria' => 'Consejos prácticos',
                'titulo' => 'Análisis de errores',
                'descripcion' => 'Revisa tus exámenes y analiza errores',
                'duracion' => '30 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Convertir errores en oportunidades de aprendizaje',
                'beneficios' => 'Prevención de errores futuros, aprendizaje significativo',
                'pasos' => '- Paso 1: Revisa trabajos/exámenes anteriores - Paso 2: Categoriza los tipos de error - Paso 3: Crea estrategias para cada tipo'
            ],

            // HISTORIAS MOTIVADORAS (10)
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Biografía inspiradora',
                'descripcion' => 'Lee la biografía de alguien que superó obstáculos',
                'duracion' => '25 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Encontrar inspiración en experiencias de superación reales',
                'beneficios' => 'Motivación renovada, perspectiva sobre desafíos',
                'pasos' => '- Paso 1: Selecciona una biografía inspiradora - Paso 2: Lee enfocándote en los desafíos - Paso 3: Reflexiona sobre aplicaciones personales'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Documental motivador',
                'descripcion' => 'Mira un documental inspirador',
                'duracion' => '45 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Visualizar el proceso de éxito y perseverancia',
                'beneficios' => 'Inspiración visual, ejemplos concretos de perseverancia',
                'pasos' => '- Paso 1: Elige un documental sobre logros - Paso 2: Toma notas de momentos clave - Paso 3: Identifica lecciones aplicables'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Caso de éxito académico',
                'descripcion' => 'Investiga un caso de éxito académico',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Aprender de estrategias académicas exitosas',
                'beneficios' => 'Modelos a seguir, métodos probados de estudio',
                'pasos' => '- Paso 1: Investiga historias de éxito académico - Paso 2: Analiza sus métodos de estudio - Paso 3: Adapta estrategias a tu estilo'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Superación personal',
                'descripcion' => 'Escribe sobre un desafío superado',
                'duracion' => '20 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Reconocer la propia capacidad de superación',
                'beneficios' => 'Auto-reconocimiento, confianza fortalecida',
                'pasos' => '- Paso 1: Recuerda un desafío personal superado - Paso 2: Describe el proceso - Paso 3: Identifica lo que aprendiste'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Entrevista inspiradora',
                'descripcion' => 'Escucha una entrevista inspiradora',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Absorber sabiduría de personas exitosas',
                'beneficios' => 'Consejos directos, perspectivas valiosas',
                'pasos' => '- Paso 1: Encuentra entrevista de alguien que admires - Paso 2: Escucha activamente - Paso 3: Resume consejos clave'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Película motivadora',
                'descripcion' => 'Ve una película sobre perseverancia',
                'duracion' => '2 horas',
                'dificultad' => 'Fácil',
                'objetivo' => 'Inspirarse mediante narrativas de superación',
                'beneficios' => 'Motivación emocional, ejemplos de resiliencia',
                'pasos' => '- Paso 1: Selecciona película con tema de superación - Paso 2: Observa patrones de perseverancia - Paso 3: Reflexiona sobre mensajes clave'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Testimonio real',
                'descripcion' => 'Lee testimonios de estudiantes',
                'duracion' => '25 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Conectar con experiencias de pares',
                'beneficios' => 'Identificación con experiencias similares, consejos prácticos',
                'pasos' => '- Paso 1: Busca testimonios de estudiantes - Paso 2: Enfócate en desafíos similares - Paso 3: Extrae estrategias aplicables'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Historia de resiliencia',
                'descripcion' => 'Reflexiona sobre alguien resiliente',
                'duracion' => '20 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Comprender las características de la resiliencia',
                'beneficios' => 'Modelo de resiliencia, estrategias de adaptación',
                'pasos' => '- Paso 1: Piensa en alguien muy resiliente - Paso 2: Analiza sus características - Paso 3: Identifica comportamientos a emular'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Logro imposible',
                'descripcion' => 'Investiga un logro académico difícil',
                'duracion' => '35 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Expandir la percepción de lo posible',
                'beneficios' => 'Ampliación de metas, inspiración por logros extraordinarios',
                'pasos' => '- Paso 1: Investiga logros académicos notables - Paso 2: Analiza el proceso - Paso 3: Aplica principios a tus metas'
            ],
            [
                'categoria' => 'Historias motivadoras',
                'titulo' => 'Mentor inspirador',
                'descripcion' => 'Aprende sobre la trayectoria de alguien que admiras',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Encontrar guía en modelos a seguir',
                'beneficios' => 'Dirección clara, aprendizaje de experiencias ajenas',
                'pasos' => '- Paso 1: Identifica a tu mentor ideal - Paso 2: Investiga su trayectoria - Paso 3: Extrae lecciones aplicables'
            ],

            // TÉCNICAS DE ESTUDIO (10)
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Subrayado inteligente',
                'descripcion' => 'Practica subrayar solo ideas clave',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Desarrollar habilidad para identificar información esencial',
                'beneficios' => 'Lectura más eficiente, mejor retención de conceptos clave',
                'pasos' => '- Paso 1: Lee primero sin subrayar - Paso 2: Identifica ideas principales - Paso 3: Subraya solo conceptos esenciales'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'SQ3R',
                'descripcion' => 'Aplica Survey, Question, Read, Recite, Review',
                'duracion' => '45 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Implementar método sistemático de lectura comprensiva',
                'beneficios' => 'Comprensión profunda, retención mejorada',
                'pasos' => '- Paso 1: Examina el texto globalmente - Paso 2: Formula preguntas clave - Paso 3: Lee, recita y revisa activamente'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Estudio espaciado',
                'descripcion' => 'Planifica repasos espaciados',
                'duracion' => '20 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Optimizar la memoria mediante repasos estratégicos',
                'beneficios' => 'Memoria a largo plazo fortalecida, menor tiempo total de estudio',
                'pasos' => '- Paso 1: Identifica material para repasar - Paso 2: Programa repasos progresivos - Paso 3: Ajusta intervalos según necesidad'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Palacio mental',
                'descripcion' => 'Crea un palacio mental',
                'duracion' => '40 minutos',
                'dificultad' => 'Difícil',
                'objetivo' => 'Dominar técnica de memorización espacial avanzada',
                'beneficios' => 'Memorización masiva, recuerdo rápido y confiable',
                'pasos' => '- Paso 1: Visualiza un lugar familiar - Paso 2: Asocia conceptos a ubicaciones - Paso 3: Recorre mentalmente para recordar'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Analogías creativas',
                'descripcion' => 'Convierte conceptos en analogías',
                'duracion' => '25 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Facilitar comprensión mediante comparaciones creativas',
                'beneficios' => 'Comprensión intuitiva, memorización más fácil',
                'pasos' => '- Paso 1: Identifica concepto difícil - Paso 2: Busca analogías de la vida real - Paso 3: Desarrolla la comparación completa'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Estudio multisensorial',
                'descripcion' => 'Usa sentidos múltiples al estudiar',
                'duracion' => '35 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Enganchar múltiples canales de aprendizaje',
                'beneficios' => 'Aprendizaje más profundo, mayor retención',
                'pasos' => '- Paso 1: Identifica tu estilo de aprendizaje - Paso 2: Incorpora 2-3 sentidos - Paso 3: Combina métodos para mejor efecto'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Diagramas de flujo',
                'descripcion' => 'Crea diagramas de procesos',
                'duracion' => '30 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Visualizar procesos complejos de manera secuencial',
                'beneficios' => 'Comprensión de procesos, identificación de pasos críticos',
                'pasos' => '- Paso 1: Identifica el proceso a diagramar - Paso 2: Define pasos y decisiones - Paso 3: Conecta secuencialmente'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Estudio activo con preguntas',
                'descripcion' => 'Formula preguntas y respóndelas',
                'duracion' => '40 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Transformar estudio pasivo en activo mediante interrogación',
                'beneficios' => 'Comprensión más profunda, preparación para exámenes',
                'pasos' => '- Paso 1: Antes de leer, formula preguntas - Paso 2: Busca respuestas activamente - Paso 3: Evalúa tu comprensión'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Técnica de Cornell',
                'descripcion' => 'Toma apuntes con método Cornell',
                'duracion' => '50 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Organizar apuntes para máximo aprovechamiento',
                'beneficios' => 'Apuntes organizados, repaso eficiente',
                'pasos' => '- Paso 1: Divide la página en secciones - Paso 2: Toma notas en área principal - Paso 3: Agrega preguntas y resumen'
            ],
            [
                'categoria' => 'Técnicas de estudio',
                'titulo' => 'Autoexplicación',
                'descripcion' => 'Explica lo aprendido cada 10 minutos',
                'duracion' => '30 minutos',
                'dificultad' => 'Media',
                'objetivo' => 'Consolidar aprendizaje mediante explicación inmediata',
                'beneficios' => 'Retención inmediata, detección de vacíos',
                'pasos' => '- Paso 1: Estudia por 10 minutos - Paso 2: Explica sin ver material - Paso 3: Verifica y corrige'
            ],

            // OTRO (10)
            [
                'categoria' => 'Otro',
                'titulo' => 'Meditación para el enfoque',
                'descripcion' => 'Practica 10 minutos de meditación',
                'duracion' => '10 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Desarrollar capacidad de concentración mediante mindfulness',
                'beneficios' => 'Mente clara, reducción de ansiedad, mejor enfoque',
                'pasos' => '- Paso 1: Busca un lugar tranquilo - Paso 2: Enfócate en la respiración - Paso 3: Observa pensamientos sin juzgar'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Ejercicio físico breve',
                'descripcion' => 'Haz 15 minutos de ejercicio',
                'duracion' => '15 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Oxigenar el cerebro y mejorar la circulación',
                'beneficios' => 'Más energía, mejor humor, mayor concentración',
                'pasos' => '- Paso 1: Elige ejercicio cardiovascular - Paso 2: Calienta 2 minutos - Paso 3: Ejercita 10-12 minutos intensos'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Alimentación cerebral',
                'descripcion' => 'Prepara comida nutritiva para estudiar',
                'duracion' => '30 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Proveer nutrientes esenciales para función cerebral óptima',
                'beneficios' => 'Energía sostenida, mejor función cognitiva',
                'pasos' => '- Paso 1: Selecciona alimentos cerebrales - Paso 2: Prepara comida balanceada - Paso 3: Consume antes de estudiar'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Descanso activo',
                'descripcion' => 'Programa descansos estratégicos',
                'duracion' => '5 min/hora',
                'dificultad' => 'Fácil',
                'objetivo' => 'Prevenir fatiga mental mediante pausas regenerativas',
                'beneficios' => 'Enfoque sostenido, prevención del agotamiento',
                'pasos' => '- Paso 1: Establece temporizador - Paso 2: Levántate y muévete - Paso 3: Cambia de ambiente brevemente'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Ambiente de estudio',
                'descripcion' => 'Optimiza tu espacio de estudio',
                'duracion' => '20 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Crear entorno propicio para concentración máxima',
                'beneficios' => 'Menos distracciones, mayor productividad',
                'pasos' => '- Paso 1: Elimina distracciones visuales - Paso 2: Organiza materiales - Paso 3: Ajusta iluminación y temperatura'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Visualización de metas',
                'descripcion' => 'Visualiza tus metas académicas',
                'duracion' => '15 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Fortalecer motivación mediante claridad de objetivos',
                'beneficios' => 'Motivación reforzada, dirección clara',
                'pasos' => '- Paso 1: Cierra los ojos y relájate - Paso 2: Visualiza el éxito académico - Paso 3: Siente las emociones del logro'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Diario de progreso',
                'descripcion' => 'Registra tus avances',
                'duracion' => '10 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Seguir evolución y celebrar progresos',
                'beneficios' => 'Motivación por progreso, autoconocimiento',
                'pasos' => '- Paso 1: Anota logros del día - Paso 2: Registra dificultades - Paso 3: Planifica mejoras'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Técnica de respiración',
                'descripcion' => 'Practica respiración anti-estrés',
                'duracion' => '10 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Reducir ansiedad y mejorar estado mental',
                'beneficios' => 'Calma inmediata, claridad mental',
                'pasos' => '- Paso 1: Siéntate cómodamente - Paso 2: Respira 4 segundos - Paso 3: Exhala 6 segundos y repite'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Recompensas sistemáticas',
                'descripcion' => 'Crea un sistema de recompensas',
                'duracion' => '15 minutos',
                'dificultad' => 'Fácil',
                'objetivo' => 'Fortalecer hábitos de estudio mediante refuerzo positivo',
                'beneficios' => 'Motivación sostenida, asociación positiva con estudio',
                'pasos' => '- Paso 1: Define logros específicos - Paso 2: Establece recompensas apropiadas - Paso 3: Aplica consistentemente'
            ],
            [
                'categoria' => 'Otro',
                'titulo' => 'Sueño reparador',
                'descripcion' => 'Planifica tu horario de sueño',
                'duracion' => 'Planificación',
                'dificultad' => 'Fácil',
                'objetivo' => 'Optimizar consolidación de memoria mediante sueño de calidad',
                'beneficios' => 'Memoria fortalecida, mejor función cognitiva',
                'pasos' => '- Paso 1: Calcula horas necesarias - Paso 2: Establece rutina constante - Paso 3: Crea ambiente propicio para dormir'
            ]
        ];

        foreach ($retos as $reto) {
            RetoDiario::create($reto);
        }
    }
}