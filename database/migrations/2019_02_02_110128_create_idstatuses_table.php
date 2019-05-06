<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bureau_househelp_id');
            $table->string('status')->nullable();//yes/no but waiting card/ no nothing at all
            $table->string('reason')->nullable();
            $table->string('id_number')->nullable();
            $table->string('ref_number')->nullable();
            $table->string('id_photo_front')->nullable();
            $table->string('id_photo_back')->nullable();
            $table->string('waiting_card_photo')->nullable();
            $table->timestamps();;
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
        Schema::dropIfExists('idstatuses');
    }
}
