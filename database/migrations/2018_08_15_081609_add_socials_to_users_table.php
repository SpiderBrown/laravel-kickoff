<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->index();
            $table->string('avatar')->nullable(true);
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('active')->default(false);
            $table->string('language')->default('en');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            $table->dropColumn('dob');
            $table->dropColumn('active');
            $table->dropColumn('language');
            $table->dropSoftDeletes();
        });
    }
}
