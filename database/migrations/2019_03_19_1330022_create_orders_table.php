<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_client_id')->unsigned();
            $table->float('total',8, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_code')->nullable();
            $table->string('transaction_image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organisation_client_id')->references('id')->on('organisation_client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
