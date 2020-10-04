<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comic_id')->references('id')->on('comics');
            $table->foreignId('story_id')->references('id')->on('stories');
            $table->foreignId('event_id')->references('id')->on('events');
            $table->foreignId('series_id')->references('id')->on('series');
            $table->string('name');
            $table->text('description');
            $table->json('urls');
            $table->json('thumbnail');
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
        Schema::dropIfExists('characters');
    }
}
