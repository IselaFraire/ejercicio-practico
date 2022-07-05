<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Estructura de la tabla
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('autor', 100);
            $table->string('titulo', 150);
            $table->integer('edicion');
            $table->text('datosPublicacion');
            $table->string('tipoContenido', 100);
            $table->string('restricciones', 100);
            $table->string('materia', 100);
            $table->string('proveedor', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
