<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousehelpOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('househelp_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('househelp_id')->unsigned();
            $table->tinyInteger('payment_confirmation')->default(0)->unsigned();
            $table->string('name');
            $table->string('gender');
            $table->string('education');
            $table->string('experience');
            $table->string('maritalstatus');
            $table->string('tribe');
            $table->string('skill');
            $table->string('operation');
            $table->string('duration');
            $table->string('englishstatus');
            $table->string('religion');
            $table->string('kid');
            $table->string('image');
            $table->string('qty');
            $table->float('fee',8, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('househelp_id')->references('id')->on('bureau_househelp')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('househelp_order');
    }
}
