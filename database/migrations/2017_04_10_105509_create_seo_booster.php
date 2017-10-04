<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoBooster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_booster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_name');
            $table->text('parameters');
            $table->timestamps();
        });

        Schema::create('language_seo_booster', function (Blueprint $table) {
            $table->integer('language_id')->unsigned();
            $table->integer('seo_booster_id')->unsigned();

            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->primary(['language_id', 'seo_booster_id']);

            $table  ->foreign('language_id')
                    ->references('id')
                    ->on('languages')
                    ->onDelete('RESTRICT');
            $table  ->foreign('seo_booster_id')
                    ->references('id')
                    ->on('seo_booster')
                    ->onDelete('RESTRICT');

            $table->timestamps();
        });

        Schema::create('photo_seo_booster', function (Blueprint $table) {
            $table->integer('photo_id')->unsigned();
            $table->integer('seo_booster_id')->unsigned();

            $table->string('use')->default('thumbnail');
            $table->unsignedInteger('order')->nullable();
            $table->string('class')->nullable();

            $table->unique(['use', 'order', 'seo_booster_id']);
            $table->unique(['photo_id', 'use', 'seo_booster_id']);

            $table  ->foreign('photo_id')
                    ->references('id')
                    ->on('photos')
                    ->onDelete('RESTRICT');
            $table  ->foreign('seo_booster_id')
                    ->references('id')
                    ->on('seo_booster')
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
        Schema::dropIfExists('photo_seo_booster');
        Schema::dropIfExists('language_seo_booster');
        Schema::dropIfExists('seo_booster');
    }
}