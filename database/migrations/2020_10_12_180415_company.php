<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('empresaNombre', 250);
            $table->string('empresaTelefono', 250);
            $table->string('empresaEmail', 250);
            $table->string('nitEmpresa', 250)->unique();
            $table->string('esmpresaDescripcion', 250);
            $table->integer('id_sector');
            $table->integer('id_user')->unique();
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
        Schema::dropIfExists('empresa');
    }
}
