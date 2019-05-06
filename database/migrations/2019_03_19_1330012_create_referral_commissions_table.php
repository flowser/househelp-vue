<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referral_link_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('househelp_id')->nullable();
            $table->string('name')->nullable();
            $table->string('househelpType')->nullable();
            $table->string('skill')->nullable();
            $table->string('employed_at')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('payment_confirmation')->default(0)->unsigned();
            $table->float('search_fee',8, 2)->nullable();
            $table->float('commission',8, 2)->nullable();
            $table->tinyInteger('payment_status')->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('househelp_id')->references('id')->on('bureau_househelp')->onDelete('cascade');
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
        Schema::dropIfExists('referral_commissions');
    }
}
