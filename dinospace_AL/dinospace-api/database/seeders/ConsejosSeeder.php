<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsejosSeeder extends Seeder
{
    public function run(): void
    {
        $consejos = [
            [
                'titulo' => 'Descanso Pomodoro',
                'descripcion' => 'Toma descansos de 5 minutos por cada 25 de estudio.'
            ],
            [
                'titulo' => 'Hidratación',
                'descripcion' => 'Toma suficiente agua para mantener tu mente activa.'
            ],
            [
                'titulo' => 'Prioriza tareas',
                'descripcion' => 'Organiza tus actividades por orden de importancia.'
            ],
            [
                'titulo' => 'Evita distracciones',
                'descripcion' => 'Coloca tu celular lejos mientras estudias.'
            ],
            [
                'titulo' => 'Reescribir ayuda',
                'descripcion' => 'Reescribir apuntes fortalece la memoria.'
            ],
            [
                'titulo' => 'Dormir bien',
                'descripcion' => 'Dormir entre 7 y 8 horas mejora tu concentración.'
            ],
            [
                'titulo' => 'Activa tu cuerpo',
                'descripcion' => 'Un poco de ejercicio mejora la productividad.'
            ],
            [
                'titulo' => 'Resume temas difíciles',
                'descripcion' => 'Haz resúmenes de los conceptos que más te cuestan.'
            ],
            [
                'titulo' => 'Enseña para aprender',
                'descripcion' => 'Explica el tema en voz alta como si enseñaras.'
            ],
            [
                'titulo' => 'Divide objetivos',
                'descripcion' => 'Parte un proyecto grande en pequeñas tareas.'
            ],
            [
                'titulo' => 'Estudia alimentado',
                'descripcion' => 'Evita estudiar con hambre o sueño excesivo.'
            ],
            [
                'titulo' => 'Mapas mentales',
                'descripcion' => 'Los esquemas visuales ayudan a comprender mejor.'
            ],
            [
                'titulo' => 'Revisión nocturna',
                'descripcion' => 'Revisa tus apuntes antes de dormir para reforzar.'
            ],
            [
                'titulo' => 'Usa colores',
                'descripcion' => 'Utiliza colores para resaltar ideas clave.'
            ],
            [
                'titulo' => 'Lugar adecuado',
                'descripcion' => 'No estudies en la cama; usa un espacio ordenado.'
            ],
            [
                'titulo' => 'Música instrumental',
                'descripcion' => 'La música suave puede ayudarte a concentrarte.'
            ],
            [
                'titulo' => 'Temporizador',
                'descripcion' => 'Usa un temporizador para administrar tu tiempo.'
            ],
            [
                'titulo' => 'Comprende, no memorices',
                'descripcion' => 'Entender es mejor que repetir sin sentido.'
            ],
            [
                'titulo' => 'Practica ejercicios',
                'descripcion' => 'Refuerza con ejercicios si tu curso es práctico.'
            ],
            [
                'titulo' => 'Pausas activas',
                'descripcion' => 'Estírate o camina un poco cada cierto tiempo.'
            ],
            [
                'titulo' => 'Evita el último minuto',
                'descripcion' => 'Estudia con anticipación para evitar estrés.'
            ],
            [
                'titulo' => 'Fichas de estudio',
                'descripcion' => 'Crea tarjetas con conceptos importantes.'
            ],
            [
                'titulo' => 'Ambiente ordenado',
                'descripcion' => 'Un escritorio limpio mejora tu enfoque.'
            ],
            [
                'titulo' => 'Sin notificaciones',
                'descripcion' => 'Desactiva notificaciones mientras estudias.'
            ],
            [
                'titulo' => 'Autoevaluación',
                'descripcion' => 'Prueba tus conocimientos al terminar un tema.'
            ],
            [
                'titulo' => 'Metas realistas',
                'descripcion' => 'No te sobreexijas; divide tus tareas por día.'
            ],
            [
                'titulo' => 'Recompénsate',
                'descripcion' => 'Date pequeñas recompensas cuando avances.'
            ],
            [
                'titulo' => 'Evita largas sesiones',
                'descripcion' => 'No estudies muchas horas seguidas sin pausas.'
            ],
            [
                'titulo' => 'Checklist diario',
                'descripcion' => 'Haz una lista de tareas y márcalas al completar.'
            ],
            [
                'titulo' => 'Salud emocional',
                'descripcion' => 'Descansa cuando lo necesites; no te presiones.'
            ],
        ];

        foreach ($consejos as $consejo) {
            DB::table('consejos')->insert([
                'titulo' => $consejo['titulo'],
                'descripcion' => $consejo['descripcion'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
