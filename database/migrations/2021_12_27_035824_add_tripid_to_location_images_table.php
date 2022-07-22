<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTripidToLocationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_images', function (Blueprint $table) {
            // $table->foreignId('trip_id')
            // ->nullable()
            // ->references('id')->on('createtrips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_images', function (Blueprint $table) {
            $table->dropForeign('location_images_trip_id_foreign');
            $table->dropColumn('trip_id');
        });
    }
}