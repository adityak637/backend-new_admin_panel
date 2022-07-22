<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTravellerIdToEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
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
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign('enquiries_traveller_id_foreign');
            $table->dropColumn('traveller_id');
        });
    }
}