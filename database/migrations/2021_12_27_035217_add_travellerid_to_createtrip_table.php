<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTravelleridToCreatetripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('createtrips', function (Blueprint $table) {
            // $table->foreignId('traveller_id')
            // ->nullable()
            // ->references('id')->on('create_travel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('createtrips', function (Blueprint $table) {
            $table->dropForeign('createtrips_traveller_id_foreign');
            $table->dropColumn('traveller_id');
        });
    }
}