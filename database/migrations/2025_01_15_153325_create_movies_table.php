<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('date');
            $table->integer('category_id');
            $table->string('country');
            $table->string('producer');
            $table->time('duration')->nullable();
            $table->string('actors');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->integer('product_id');
            $table->string('alias')->unique()->nullable();
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
        Schema::dropIfExists('movies');
    }
};
