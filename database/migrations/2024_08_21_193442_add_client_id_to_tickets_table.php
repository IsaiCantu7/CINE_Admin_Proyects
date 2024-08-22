<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToTicketsTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable()->after('id');

            // Si deseas agregar una clave foránea, descomenta la siguiente línea:
            // $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Si agregaste una clave foránea, descomenta la siguiente línea:
            // $table->dropForeign(['client_id']);
            
            $table->dropColumn('client_id');
        });
    }
}
