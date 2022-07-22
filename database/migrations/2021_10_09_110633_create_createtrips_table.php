<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatetripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('createtrips', function (Blueprint $table) {
            $table->id();
            $table->string('traveller_id')->nullable();
            $table->string('trip_id')->nullable();
            $table->string('trip_title')->nullable();
            $table->string('intro')->nullable();
            $table->string('short_message')->nullable();
            $table->string('type_of_trip')->nullable();
            $table->string('desination_name')->nullable();
            $table->string('start_location')->nullable();
            $table->string('end_location')->nullable();
            $table->date('start_date')->format('d-m-Y')->nullable();
            $table->date('end_date')->format('d-m-Y')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('itinerary')->nullable();
            $table->string('advises')->nullable();
            $table->string('B_number')->nullable();
            $table->string('guidelines')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('thumbnail_photo')->nullable();
            $table->string('promo_code')->nullable();
            $table->string('term_and_condition')->nullable();
            $table->string('booking_close')->nullable();
            $table->string('discount_type')->nullable();
            $table->Double('cost')->nullable();
            $table->Integer('hotlocation')->default('0');
            $table->tinyInteger('status')->default('0')->comment(' 1 = archived 2 = underreview 3 = rejected 4 = ongoing 5 = cancelled');
            $table->string('trip_status')->nullable();
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
        Schema::dropIfExists('createtrips');
    }
}