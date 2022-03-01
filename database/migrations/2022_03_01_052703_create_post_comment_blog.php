<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_post', function (Blueprint $table) {
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('comment_id')->unsigned();

            $table->foreign('post_id')->references('posts')->on('id')->onDelete('cascade');
            $table->foreign('comment_id')->references('comments')->on('id')->onDelete('cascade');

            $table->primary(['post_id','comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_post');
    }
}
