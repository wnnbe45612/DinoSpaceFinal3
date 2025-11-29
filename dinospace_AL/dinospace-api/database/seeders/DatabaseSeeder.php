<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama a todos los seeders en orden
        $this->call([
            ConsejosSeeder::class,
            RetosDiariosSeeder::class,
        ]);
        
        // Mensaje de confirmación
        $this->command->info('Seeders ejecutados correctamente!');
        $this->command->info('Consejos y Retos Diarios agregados a la base de datos.');
    }
}