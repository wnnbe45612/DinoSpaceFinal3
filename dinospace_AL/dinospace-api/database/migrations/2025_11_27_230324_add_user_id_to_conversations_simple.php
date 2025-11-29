<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Desactivar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Limpiar datos existentes
        DB::table('messages')->truncate();
        DB::table('conversations')->truncate();
        
        // Reactivar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Modificar la tabla conversations
        Schema::table('conversations', function (Blueprint $table) {
            // Agregar user_id
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            
            // Eliminar el índice único de session_id
            $table->dropUnique('conversations_session_id_unique');
            
            // Crear índice compuesto único
            $table->unique(['user_id', 'session_id']);
        });
    }

    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            // Eliminar clave foránea
            $table->dropForeign(['user_id']);
            
            // Eliminar índice compuesto
            $table->dropUnique(['user_id', 'session_id']);
            
            // Eliminar columna
            $table->dropColumn('user_id');
            
            // Restaurar índice único de session_id
            $table->unique('session_id');
        });
    }
};