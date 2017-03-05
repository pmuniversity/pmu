<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index();
            $table->string('source_url')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('web_picture', 255)->nullable();
            $table->string('mobile_picture', 255)->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('last_user_id');
            $table->string('author_name')->nullable();
            $table->string('author_location')->nullable();
            $table->string('author_organization')->nullable();
            $table->string('author_designation')->nullable();
            $table->string ( 'author_picture' )->nullable ();
            $table->unsignedInteger('top10_order')->default(1);
            $table->unsignedInteger('latest_order')->default(1);
            $table->unsignedTinyInteger('status')->default(1)->index();
            $table->unsignedInteger('upvotes_count')->default(0);
            $table->unsignedInteger('downvotes_count')->default(0);
            $table->date('date');
            $table->boolean('top')->default(0);

            // Timestamps
            $table->timestamps();

            // Soft delete
            $table->softDeletes()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
