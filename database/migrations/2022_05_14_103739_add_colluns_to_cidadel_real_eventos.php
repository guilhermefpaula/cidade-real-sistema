<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollunsToCidadelRealEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cidade_real_eventos', function (Blueprint $table) {
           $table->string('proximo_evento')->nullable();
           $table->string('tamanho')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cidade_real_eventos', function (Blueprint $table) {
            //
        });
    }
}
