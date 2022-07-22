<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->Integer('trip_id');
            $table->Integer('rating')->nullable();
            $table->string('review')->nullable();
            $table->Integer('status')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('user_reviews');
    }
}