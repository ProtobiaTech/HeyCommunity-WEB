<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

class CreateTopicNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_nodes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->unsigned()->nullable()->index()->comment('Parent ID');
            $table->foreign('parent_id')->references('id')->on('topic_nodes');

            $table->string('name', 191)->comment('Node Name');
            $table->text('description')->nullable()->comment('Description');

            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });


        Model::unguard();
        //
        $rootNode = \App\TopicNode::create([
            'name'      =>      env('LOCALE') === 'zh-CN' ? '默认' : 'Default',
        ]);
        $rootNode->makeRoot();

        $node = \App\TopicNode::create([
            'name'      =>      env('LOCALE') === 'zh-CN' ? '未分类' : 'Unclassified',
        ]);
        $node->makeChildOf($rootNode);

        Model::reguard();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_nodes');
    }
}
