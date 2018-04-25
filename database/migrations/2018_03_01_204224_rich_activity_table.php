<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RichActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('start_time')->after('user_id')->comment('Start Time');
            $table->string('end_time')->after('start_time')->comment('End Time');

            $table->string('local')->after('intro')->comment('Activity Local');
            $table->string('redirect_url')->after('local')->comment('Activity Redirect URL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time', 'local', 'redirect_url']);
        });
    }
}
