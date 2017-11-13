<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('wx_open_id')->nullable()->comment('Wechat Open ID');
            $table->string('wx_union_id')->nullable()->comment('Wechat Union ID');
            $table->string('nickname')->comment('Nickname');
            $table->string('gender')->nullable()->comment('Gender');
            $table->string('bio')->nullable()->comment('Bio');
            $table->string('avatar')->default('/images/user/avatar/default.png')->comment('Avatar');
            $table->string('profile_bg_img')->default('/images/user/profile_bg_img.jpg')->comment('Avatar');
            $table->string('phone')->nullable()->comment('Phone');
            $table->string('email')->nullable()->comment('Email');
            $table->string('password')->nullable()->comment('Password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
