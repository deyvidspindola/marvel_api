<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_comic', function (Blueprint $table) {
            $table->bigInteger('character_id');
            $table->bigInteger('comic_id');
        });

        Schema::create('character_event', function (Blueprint $table) {
            $table->bigInteger('character_id');
            $table->bigInteger('event_id');
        });

        Schema::create('character_series', function (Blueprint $table) {
            $table->bigInteger('character_id');
            $table->bigInteger('series_id');
        });

        Schema::create('character_story', function (Blueprint $table) {
            $table->bigInteger('character_id');
            $table->bigInteger('story_id');
        });

//        Schema::create('creator_event', function (Blueprint $table) {
//            $table->bigInteger('event_id');
//            $table->bigInteger('creator_id');
//        });
//
//        Schema::create('creator_series', function (Blueprint $table) {
//            $table->bigInteger('series_id');
//            $table->bigInteger('creator_id');
//        });
//
//        Schema::create('creator_story', function (Blueprint $table) {
//            $table->bigInteger('story_id');
//            $table->bigInteger('creator_id');
//        });
//
//        Schema::create('comic_creator', function (Blueprint $table) {
//            $table->bigInteger('comic_id');
//            $table->bigInteger('creator_id');
//        });
//
//        Schema::create('comic_event', function (Blueprint $table) {
//            $table->bigInteger('comic_id');
//            $table->bigInteger('event_id');
//        });
//
//        Schema::create('comic_series', function (Blueprint $table) {
//            $table->bigInteger('comic_id');
//            $table->bigInteger('series_id');
//        });
//
//        Schema::create('comic_story', function (Blueprint $table) {
//            $table->bigInteger('comic_id');
//            $table->bigInteger('story_id');
//        });
//
//        Schema::create('event_story', function (Blueprint $table) {
//            $table->bigInteger('story_id');
//            $table->bigInteger('event_id');
//        });
//
//        Schema::create('series_story', function (Blueprint $table) {
//            $table->bigInteger('story_id');
//            $table->bigInteger('series_id');
//        });
//
//        Schema::create('event_series', function (Blueprint $table) {
//            $table->bigInteger('event_id');
//            $table->bigInteger('series_id');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_comic');
        Schema::dropIfExists('character_event');
        Schema::dropIfExists('character_series');
        Schema::dropIfExists('character_story');
        Schema::dropIfExists('comic_event');
        Schema::dropIfExists('comic_series');
        Schema::dropIfExists('comic_story');
        Schema::dropIfExists('comic_creator');
        Schema::dropIfExists('event_series');
        Schema::dropIfExists('event_story');
        Schema::dropIfExists('series_story');
        Schema::dropIfExists('creator_event');
        Schema::dropIfExists('creator_series');
        Schema::dropIfExists('creator_story');
    }
}
