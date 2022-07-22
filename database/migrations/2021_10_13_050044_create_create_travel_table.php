<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_travel', function (Blueprint $table) {
            $table->id();
            $table->string('First_Name')->nullable();
            $table->string('Last_Name')->nullable();
            $table->string('Short_Intro')->nullable();
            $table->string('email')->unique();
            $table->string('DOB')->nullable();
            $table->string('Contact_No')->nullable();
            $table->string('password')->nullable();
            $table->string('Country')->nullable();
            $table->string('City')->nullable();
            $table->string('Pin_Code')->nullable();
            $table->string('Profile_URLs')->nullable();
            $table->string('link1')->nullable();
            $table->string('link2')->nullable();
            $table->string('link3')->nullable();
            $table->string('otp')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('role')->default('traveller');
           $table->SoftDeletes();
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
        Schema::dropIfExists('create_travel');
    }
}