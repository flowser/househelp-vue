<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');//edited or creted by
            $table->unsignedInteger('organisation_id')->nullable();
            $table->string('title', 120);
            $table->string('subtitle');
            $table->string('front_image')->nullable();
            $table->longText('why_choose_us')->nullable();
            $table->longText('who_we_are')->nullable();
            $table->longText('what_we_do')->nullable();
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
