<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Queue\NullQueue;
use Illuminate\Support\Facades\Schema;

class CreateEstrategiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estrategias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('nome_estrategia');
            $table->double('capital_aloc_corr',10,2);
            $table->string('tipo_oper');
            $table->double('capital_dest_op',10,2);
            $table->double('rr_gain',10,2);
            $table->double('rr_loss',10,2);
            $table->double('meta_f_d',10,2);
            $table->double('meta_f_s',10,2);
            $table->double('meta_f_m',10,2);
            $table->integer('meta_p_d');
            $table->integer('meta_p_s');
            $table->integer('meta_p_m');
            $table->double('loss_f_d',10,2);
            $table->double('loss_f_s',10,2);
            $table->double('loss_f_m',10,2);
            $table->double('loss_p_d',10,2);
            $table->double('loss_p_s',10,2);
            $table->double('loss_p_m',10,2);
            $table->longText('passo_a_passo');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('estrategias');
    }
}
