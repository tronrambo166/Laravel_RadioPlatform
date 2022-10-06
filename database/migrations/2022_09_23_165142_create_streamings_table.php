<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('youtube_id');
            $table->string('youtube_uuid');
            $table->string('spotify_id');
            $table->string('spotify_uuid');
            $table->string('deezer_id');
            $table->string('apple_id');
            $table->string('boomplay_id');
            $table->string('mdundo_id');
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
        Schema::dropIfExists('streamings');
    }
}
