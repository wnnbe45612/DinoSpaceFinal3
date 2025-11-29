<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('retos_diarios', function (Blueprint $table) {
            $table->text('objetivo')->nullable();
            $table->text('beneficios')->nullable();
            $table->text('pasos')->nullable();
        });
    }

    public function down()
    {
        Schema::table('retos_diarios', function (Blueprint $table) {
            $table->dropColumn(['objetivo', 'beneficios', 'pasos']);
        });
    }
};
