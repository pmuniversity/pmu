<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('level_title', ["Bachelors degree", "Masters degree", "Specialization"])->default("Bachelors degree");
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('last_user_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('summary')->nullable();
            $table->string('note_title')->nullable();
            $table->longText('note_description')->nullable();
            $table->string('web_picture', 255)->nullable();
            $table->string('web_hover_picture', 255)->nullable();
            $table->string('mobile_picture', 255)->nullable();
            $table->string('mobile_hover_picture', 255)->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->index();
            $table->unsignedTinyInteger('featured')->default(0)->index();
            $table->date('date');

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
        Schema::dropIfExists('topics');
    }
}
