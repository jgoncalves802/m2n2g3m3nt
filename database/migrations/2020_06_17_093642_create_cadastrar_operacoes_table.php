<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCadastrarOperacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastrar_operacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->string('ativo_operacao');
            $table->dateTime('abertura_operacao');
            $table->dateTime('fechamento_operacao');
            $table->string('tempo_operacao');
            $table->integer('qtd_operacao');
            $table->string('lado_operacao');
            $table->double('preco_compra_operacao',10,2);
            $table->double('preco_venda_operacao',10,2);
            $table->double('mep_operacao',10,2);
            $table->double('men_operacao',10,2);
            $table->string('medio_operacao',10,2);
            $table->double('resultado_operacao',10,2);
            $table->double('resultado_porcetangem',10,2);
            $table->double('Total',10,2);
            $table->string('nome_estrategia')->nullable();
            $table->string('nome_trading_plan')->nullable();
            $table->date('data_abertura_operacao');
            $table->date('data_fechamento_operacao');
            $table->string('email')->nullable();            
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
        Schema::dropIfExists('cadastrar_operacoes');
    }
}
