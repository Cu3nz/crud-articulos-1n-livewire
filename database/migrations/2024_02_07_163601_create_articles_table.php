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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table -> string('nombre') -> unique(); //? Va a ser unico en la base de datos
            $table -> string('descripcion');
            $table -> enum('estado' , ['DISPONIBLE' , 'NO DISPONIBLE']);
            $table -> string('imagen');
            $table -> foreignId('category_id') -> constrained() -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
