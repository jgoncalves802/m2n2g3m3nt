<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradinPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradin_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('nome_trading_plan');
            $table->string('tipo_oper');
            $table->double('capital_dest_op',10,2);
            $table->string('corret',100);
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
        Schema::dropIfExists('tradin_plans');
    }
}
