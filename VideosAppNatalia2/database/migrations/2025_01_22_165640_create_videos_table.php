<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
{
    Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('url');
        $table->timestamp('published_at')->nullable();
        $table->unsignedBigInteger('previous')->nullable();
        $table->unsignedBigInteger('next')->nullable();
        $table->unsignedBigInteger('series_id')->nullable();
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
}