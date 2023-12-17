<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectedTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connected_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction1_id');
            $table->integer('transaction2_id');
            $table->string('connect_type');
            $table->timestamps();

            $table->foreign('transaction1_id')->references('id')->on('transactions');
            $table->foreign('transaction2_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connected_trans');
    }
}
