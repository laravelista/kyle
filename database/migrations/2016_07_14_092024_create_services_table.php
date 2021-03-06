<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->string('title');
            $table->text('note')->nullable();
            $table->integer('month')->unsigned();
            $table->integer('day')->unsigned();
            $table->integer('cost')->unsigned();
            $table->string('currency'); // HRK, USD, EUR
            $table->double('exchange_rate')->default(1); // Default to USD currency
            $table->boolean('active');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->increments('id');
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
        Schema::drop('services');
    }
}
