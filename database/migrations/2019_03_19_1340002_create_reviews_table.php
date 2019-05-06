<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('househelp_id');
            $table->unsignedInteger('client_id');
            $table->text('review')->nullable();
            $table->string('what_to_improve')->nullable();
            $table->string('work_efficiency_rating')->nullable();
            $table->string('hygiene_rating')->nullable();
            $table->string('children_rapport_rating')->nullable();
            $table->string('truthfullness_rating')->nullable();
            $table->string('morality_rating')->nullable();
            $table->string('obedience_rating')->nullable();
            $table->tinyInteger('approval_status')->default(0)->unsigned(); //pending aproval
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('househelp_id')->references('id')->on('bureau_househelp')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
