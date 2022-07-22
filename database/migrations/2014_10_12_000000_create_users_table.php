<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('profile')->nullable();
            $table->string('mobile')->nullable();
            $table->string('dob')->nullable();
            $table->string('security_key')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('role')->default('user');
            $table->Integer('verifycode')->nullable();
            $table->string('short_intro')->nullable();
            $table->string('insta_handle')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->rememberToken();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}