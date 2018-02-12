<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationRequirementNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requirement_names', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable();
            $table->double('base_rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('requirement_names', function (Blueprint $table) {
            $table->dropColumn(['parent_id','base_rate']);
        });
    }
}
