<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallOfKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls_of_knowledge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image_1_title', 255)->nullable();
            $table->string('image_1_web_picture', 255)->nullable();
            $table->string('image_1_mobile_picture', 255)->nullable();
            $table->string('image_1_url', 255)->nullable();
            $table->boolean('image_1_open_new_window')->default(0);
            $table->string('image_2_title', 255)->nullable();
            $table->string('image_2_web_picture', 255)->nullable();
            $table->string('image_2_mobile_picture', 255)->nullable();
            $table->string('image_2_url', 255)->nullable();
            $table->boolean('image_2_open_new_window')->default(0);
            $table->string('image_3_title', 255)->nullable();
            $table->string('image_3_web_picture', 255)->nullable();
            $table->string('image_3_mobile_picture', 255)->nullable();
            $table->string('image_3_url', 255)->nullable();
            $table->boolean('image_3_open_new_window')->default(0);
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
        Schema::dropIfExists('halls_of_knowledge');
    }
}
