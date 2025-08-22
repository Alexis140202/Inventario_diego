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
        // Crear tabla de tiendas
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 191);
            $table->string('descripcion', 255)->nullable();
            $table->longText('imagen')->nullable();
            $table->timestamps();
        });

        // Crear tabla de Categorias
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 191);
            $table->timestamps();
        });

        //tabla de marcas relacionado con categorias
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 191);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
