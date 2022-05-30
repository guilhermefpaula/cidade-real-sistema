<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelatoriosStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsavel_id');
            $table->string('nome', 64);
            $table->string('id_player', 64);
            $table->text('motivo');
            $table->text('como_ajudou');
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
        //
    }
}
