<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquireOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquire_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquire_id')->unsigned();
            $table->foreign('enquire_id')->references('id')->on('enquires')->onDelete('cascade');
            $table->integer('option_id')->unsigned()->nullable();
            $table->foreign('option_id')->references('id')->on('option_values')->onDelete('set null');
            $table->integer('option_value_id')->unsigned()->nullable();
            $table->foreign('option_value_id')->references('id')->on('option_values')->onDelete('set null');
            $table->string('current_option_subject');
            $table->double('current_option_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquire_options');
    }
}
