<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
           $table->id();
            $table->Integer('user_id')->nullable();
            $table->Integer('trip_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('refunds')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}