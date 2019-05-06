<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_employee', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('organisation_id');
            $table->unsignedInteger('position_id');
            $table->unsignedInteger('gender_id')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('active')->default(1)->unsigned();

            $table->string('id_no', 120)->nullable();
            $table->string('id_photo_front', 120)->nullable();
            $table->string('id_photo_back', 120)->nullable();
            $table->longText('about_me')->nullable();
            $table->string('phone')->nullable();
            $table->string('landline')->nullable();
            $table->string('address', 120)->nullable();

            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('county_id')->unsigned()->nullable();
            $table->integer('constituency_id')->unsigned()->nullable();
            $table->integer('ward_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('cascade');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');

            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
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
        Schema::dropIfExists('organisation_employee');
    }
}
