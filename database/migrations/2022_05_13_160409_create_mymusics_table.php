<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMymusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mymusics', function (Blueprint $table) {
            $table->id();
            $table->integer('title');
            $table->string('album');
            $table->string('album title');
            $table->string('description');
            $table->string('album_description');
             $table->string('composer');
              $table->string('publisher');
               $table->string('song_art');
                $table->string('image');
                 $table->integer('is_album');

                
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
        Schema::dropIfExists('mymusics');
    }
}
