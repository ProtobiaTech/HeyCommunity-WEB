<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicThumbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_thumbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->index()->comment('Thumb Type');

            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('topic_id')->index()->unsigned()->comment('Topic Id');
            $table->foreign('topic_id')->references('id')->on('topics');

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
        Schema::dropIfExists('topic_thumbs');
    }
}
