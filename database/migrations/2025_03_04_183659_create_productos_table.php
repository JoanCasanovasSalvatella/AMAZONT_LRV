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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('oferta');
            $table->text('imagen');
            $table->longText('descripcion');
            $table->double('precio', 8, 2);
            $table->double('precioAnterior', 8, 2)->nullable();
            $table->integer('cantidad');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
