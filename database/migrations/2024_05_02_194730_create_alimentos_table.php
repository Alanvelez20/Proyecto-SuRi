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
        Schema::create('alimentos', function (Blueprint $table) {
            $table->id();
            $table->string('alimento_descripcion');
            $table->integer('alimento_cantidad');
            $table->integer('alimento_costo');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('archivo_ubicacion');
            $table->string('archivo_nombre');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alimentos');
    }
};
