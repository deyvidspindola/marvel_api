<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->integer('digitalId');
            $table->string('title');
            $table->double('issueNumber');
            $table->text('variantDescription');
            $table->text('description');
            $table->string('isbn')->nullable();
            $table->string('upc');
            $table->string('diamondCode');
            $table->string('ean')->nullable();
            $table->string('issn')->nullable();
            $table->string('format');
            $table->integer('pageCount');
            $table->json('prices');
            $table->json('thumbnail');
            $table->json('images');
            $table->json('urls');
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
        Schema::dropIfExists('comics');
    }
}
