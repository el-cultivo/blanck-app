<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->text('rules');
            $table->timestamps();
        });

        Schema::create('component_language', function (Blueprint $table) {
            $table->integer('language_id')->unsigned();
            $table->integer('component_id')->unsigned();

            $table->string('title')->default('');
            $table->string('label')->default('');
            $table->string('slug')->unique()->nullable();
            $table->text('content');

            $table->primary(['language_id', 'component_id']);

            $table  ->foreign('language_id')
                    ->references('id')
                    ->on('languages')
                    ->onDelete('RESTRICT');
            $table  ->foreign('component_id')
                    ->references('id')
                    ->on('components')
                    ->onDelete('RESTRICT');

            $table->timestamps();
        });

        Schema::create('component_photo', function (Blueprint $table) {
            $table->integer('photo_id')->unsigned();
            $table->integer('component_id')->unsigned();

            $table->string('use')->default('thumbnail');
            $table->unsignedInteger('order')->nullable();
            $table->string('class')->nullable();

            $table->unique(['use', 'order', 'component_id']);
            $table->unique(['photo_id', 'use', 'component_id']);

            $table  ->foreign('photo_id')
                    ->references('id')
                    ->on('photos')
                    ->onDelete('RESTRICT');
            $table  ->foreign('component_id')
                    ->references('id')
                    ->on('components')
                    ->onDelete('RESTRICT');

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
        Schema::dropIfExists('component_photo');
        Schema::dropIfExists('component_language');
        Schema::dropIfExists('components');
    }
}
