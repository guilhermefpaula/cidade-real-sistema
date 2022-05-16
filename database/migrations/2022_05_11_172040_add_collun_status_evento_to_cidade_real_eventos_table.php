<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollunStatusEventoToCidadeRealEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cidade_real_eventos', function (Blueprint $table) {
            $table->string('status_evento')->default('PLANEJAMENTO');
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
