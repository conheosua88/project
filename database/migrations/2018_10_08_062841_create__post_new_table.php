<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->string('view')->nullable();
            $table->integer('category_new_id');
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
        Schema::dropIfExists('post_new');
    }
}
