<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referral_link_id');
            $table->unsignedInteger('user_id');
            $table->float('fee',8, 2)->nullable();
            $table->float('commission',8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('referral_link_id')->references('id')->on('referral_links')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_relationships');
    }
}
