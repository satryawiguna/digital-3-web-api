<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->timestamp('current_login')->useCurrent();
            $table->string('current_ip_address', 10)->default('0.0.0.0');
            $table->tinyInteger('status', false, false)->default(0)->comment('0: not active, 1: active, 2: banned');
            $table->rememberToken();
            $table->timestamps();
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
        Schema::drop('users');
    }
}
