<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reviews', function (Blueprint $table) {
            // $table->foreignId('user_id')
            // ->nullable()
            // ->references('id')->on('users');
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
        Schema::table('user_reviews', function (Blueprint $table) {
            $table->dropForeign('user_reviews_trip_id_foreign');
            $table->dropColumn('trip_id');
            $table->dropForeign('user_reviews_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}