<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralHousehelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_househelps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('househelp_id');
            $table->string('uri');
            $table->integer('lifetime_days')->default(7);//how long will cookie last
            $table->timestamps();

            $table->foreign('househelp_id')->references('id')->on('bureau_househelp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_househelps');
    }
}
