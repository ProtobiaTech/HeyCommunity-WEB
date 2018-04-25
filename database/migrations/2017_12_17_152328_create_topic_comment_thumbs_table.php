<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicCommentThumbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_comment_thumbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->index()->comment('Thumb Type');

            $table->integer('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('topic_id')->index()->unsigned()->comment('Topic ID');
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->integer('topic_comment_id')->index()->unsigned()->comment('Topic Comment ID');
            $table->foreign('topic_comment_id')->references('id')->on('topic_comments');

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
        Schema::dropIfExists('topic_comment_thumbs');
    }
}
