<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadeRealEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidade_real_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->integer('min_players');
            $table->integer('min_staffs');
            $table->string('frequencia')->nullable();
            $table->text('backstory');
            $table->text('realizacao')->nullable();
            $table->text('observacoes')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('responsavel');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidade_real_eventos');
    }
}
