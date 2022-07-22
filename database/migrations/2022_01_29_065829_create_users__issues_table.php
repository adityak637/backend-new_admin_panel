<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users__issues', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('useremail');
            $table->string('transactionId');
            $table->string('tripId');
            $table->string('details');
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
        Schema::dropIfExists('users__issues');
    }
}