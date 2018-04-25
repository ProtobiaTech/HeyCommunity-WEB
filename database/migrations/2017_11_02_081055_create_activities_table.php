<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->comment('Activity Title');
            $table->string('avatar')->comment('Activity Avatar');
            $table->string('intro')->comment('Activity Intro');
            $table->text('content')->comment('Activity Content');

            $table->integer('read_num')->default(0)->comment('Read Number');
            $table->integer('favorite_num')->default(0)->comment('Favorite Number');
            $table->integer('participant_num')->default(0)->comment('Participant Number');
            $table->integer('comment_num')->default(0)->comment('Comment Number');
            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Number');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Down Number');

            $table->integer('is_exhibited')->default(0)->comment('Whether On Display');
            $table->dateTime('exhibited_at')->nullable()->comment('Exhibit Time');
            $table->integer('is_pinned')->default(0)->comment('Whether On Pinned');
            $table->dateTime('pinned_at')->nullable()->comment('Pin Time');

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
        Schema::dropIfExists('activities');
    }
}
