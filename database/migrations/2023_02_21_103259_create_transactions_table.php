<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('subject');
            $table->integer('trans_type_id');
            $table->integer('secret_id');
            $table->integer('importance_id');
            $table->integer('trans_status_id');
            $table->integer('user_id');
            $table->morphs('type');
            $table->timestamps();

            $table->foreign('trans_type_id')->references('id')->on('trans_types');
            $table->foreign('secret_id')->references('id')->on('secrets');
            $table->foreign('importance_id')->references('id')->on('importances');
            $table->foreign('trans_status_id')->references('id')->on('trans_statuses');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
