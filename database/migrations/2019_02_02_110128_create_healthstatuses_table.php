<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bureau_househelp_id');
            $table->string('status')->nullable(); //HIV, ellergy, anyother
            $table->string('HIV_status')->nullable();
            $table->string('other_chronics')->nullable();
            $table->string('chronic_details')->nullable();
            $table->string('allergy')->nullable();
            $table->string('specify')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bureau_househelp_id')->references('id')->on('bureau_househelp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('healthstatuses');
    }
}
