<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('social_id')->nullable(true);
            $table->string('name');
            $table->string('email')->nullable(false);
            $table->string('avatar')->nullable(true);
            $table->string('social')->nullable(true);
            $table->string('access_token')->nullable(true);
            $table->string('refresh_token')->nullable(true);
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
        Schema::dropIfExists('social_users');
    }
}
