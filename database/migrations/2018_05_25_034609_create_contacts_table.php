<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website');
            $table->string('company_name');
            $table->string('email');
            $table->string('phone');
            $table->string('open_position');
            $table->text('observations');
            $table->unsignedInteger('contact_type_id');
            $table->unsignedInteger('contact_status_id');
            $table->unsignedInteger('city_id');
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
            $table->foreign('contact_status_id')->references('id')->on('contact_statuses');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('contacts');
    }
}
