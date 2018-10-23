<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('departure_location')->nullable();
            $table->string('trip_time')->nullable();
            $table->integer('vehicle')->nullable();
            $table->string('departure_time')->nullable();
            $table->text('tour_schedule')->nullable();
            $table->string('price')->nullable();
            $table->string('promotional price')->nullable();
            $table->text('rules')->nullable();
            $table->text('regulations')->nullable();
            $table->integer('status')->nullable();
            $table->integer('category_id');
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
        Schema::dropIfExists('post');
    }
}
