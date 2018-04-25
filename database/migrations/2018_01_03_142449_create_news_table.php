<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin')->comment('News Origin');
            $table->string('category')->comment('News Category');
            $table->string('title')->comment('News Title');
            $table->text('content')->comment('News Content');
            $table->string('avatar')->comment('News Avatar');
            $table->text('gallery')->comment('News Gallery');
            $table->string('url')->comment('News URL');
            $table->string('weburl')->comment('News WebURL');
            $table->dateTime('time')->comment('News Time');

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
        Schema::dropIfExists('news');
    }
}
