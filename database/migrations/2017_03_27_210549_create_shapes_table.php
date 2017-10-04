<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('route_name');

            $table->unique([ 'route_name','key']);
            $table->timestamps();
        });

        Schema::create('photo_shape', function (Blueprint $table) {
            $table->integer('photo_id')->unsigned();
            $table->integer('shape_id')->unsigned();

            $table->string('use')->default('thumbnail');
            $table->unsignedInteger('order')->nullable();
            $table->string('class')->nullable();

            $table->unique(['use', 'order', 'shape_id']);
            $table->unique(['photo_id', 'use', 'shape_id']);

            $table  ->foreign('photo_id')
                    ->references('id')
                    ->on('photos')
                    ->onDelete('RESTRICT');
            $table  ->foreign('shape_id')
                    ->references('id')
                    ->on('shapes')
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
        Schema::dropIfExists('photo_shape');
        Schema::dropIfExists('shapes');
    }
}
