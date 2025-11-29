<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('retos_diarios', function (Blueprint $table) {
            $table->id();
            $table->string('categoria'); // Consejos prácticos, Historias motivadoras, etc.
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('duracion');
            $table->enum('dificultad', ['Fácil', 'Media', 'Difícil']);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('retos_diarios');
    }
};