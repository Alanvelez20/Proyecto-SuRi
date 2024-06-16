<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigInteger('arete')->unique();
            $table->string('animal_especie');
            $table->string('animal_genero');
            $table->float('animal_peso_inicial');
            $table->float('animal_peso_final');
            $table->float('animal_valor_compra');
            $table->float('animal_valor_venta');
            $table->float('consumo_total');
            $table->date('fecha_ingreso');
            $table->foreignId('animal_id_lote');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
