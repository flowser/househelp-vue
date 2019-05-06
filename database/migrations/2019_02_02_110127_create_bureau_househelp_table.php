<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBureauHousehelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bureau_househelp', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('bureau_id');
            //Househelp details
            $table->string('photo')->nullable();
            $table->string('age')->nullable();

            // $table->float('search_fee', 8, 2);
            $table->longText('about_me')->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 120)->nullable();
            //statuses
            $table->tinyInteger('active')->default(1)->unsigned();
            $table->tinyInteger('employmentstatus')->default(0)->unsigned();
            $table->tinyInteger('hiredstatus')->default(0)->unsigned();

            //stand filters
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('county_id')->unsigned()->nullable();
            $table->integer('constituency_id')->unsigned()->nullable();
            $table->integer('ward_id')->unsigned()->nullable();

            //househelp filters
            $table->integer('education_id')->unsigned()->nullable();
            $table->integer('gender_id')->unsigned()->nullable();
            $table->integer('experience_id')->unsigned()->nullable();
            $table->integer('maritalstatus_id')->unsigned()->nullable();
            $table->integer('tribe_id')->unsigned()->nullable();
            $table->integer('skill_id')->unsigned()->nullable();
            $table->integer('operation_id')->unsigned()->nullable();
            $table->integer('duration_id')->unsigned()->nullable();
            $table->integer('englishstatus_id')->unsigned()->nullable();
            $table->integer('religion_id')->unsigned()->nullable();
            $table->integer('kid_id')->unsigned()->nullable();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('cascade');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');


            $table->foreign('bureau_id')->references('id')->on('bureaus')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('education_id')->references('id')->on('education')->onDelete('cascade');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('maritalstatus_id')->references('id')->on('maritalstatuses')->onDelete('cascade');
            $table->foreign('tribe_id')->references('id')->on('tribes')->onDelete('cascade');
            $table->foreign('operation_id')->references('id')->on('operations')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->foreign('englishstatus_id')->references('id')->on('englishstatuses')->onDelete('cascade');
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bureau_househelp');
    }
}
