<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTopicCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topic_comments', function (Blueprint $table) {
            $table->integer('root_id')->unsigned()->nullable()->after('id')->comment('Comment Root ID');
            $table->foreign('root_id')->references('id')->on('topic_comments');
            $table->integer('parent_id')->unsigned()->nullable()->after('root_id')->comment('Comment Parent ID');
            $table->foreign('parent_id')->references('id')->on('topic_comments');

            $table->integer('thumb_up_num')->default(0)->after('content')->comment('Thumb Up Number');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Down Number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topic_comments', function (Blueprint $table) {
            $table->dropForeign('topic_comments_root_id_foreign');
            $table->dropForeign('topic_comments_parent_id_foreign');
            $table->dropColumn(['root_id', 'parent_id', 'thumb_up_num', 'thumb_down_num']);
        });
    }
}
