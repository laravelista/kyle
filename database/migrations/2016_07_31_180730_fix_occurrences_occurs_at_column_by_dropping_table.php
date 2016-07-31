<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixOccurrencesOccursAtColumnByDroppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('occurrences');

        Schema::create('occurrences', function (Blueprint $table) {
            $table->dateTime('occurs_at');
            $table->boolean('offer_sent')->nullable();
            $table->boolean('payment_received')->nullable();
            $table->boolean('receipt_sent')->nullable();
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::drop('occurrences');

        Schema::create('occurrences', function (Blueprint $table) {
            $table->timestamp('occurs_at');
            $table->boolean('offer_sent')->nullable();
            $table->boolean('payment_received')->nullable();
            $table->boolean('receipt_sent')->nullable();
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->increments('id');
            $table->timestamps();
        });
    }
}
