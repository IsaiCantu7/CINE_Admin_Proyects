<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToMoviesTable extends Migration
{
    /**
     * Ejecuta las modificaciones de la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description'); // Añadir columna 'image' después de 'description'
        });
    }

    /**
     * Revierte las modificaciones de la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('image'); // Elimina la columna 'image' si se revierte la migración
        });
    }
}
