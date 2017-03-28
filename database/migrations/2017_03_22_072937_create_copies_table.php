<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('route_name');

            $table->unique([ 'route_name','key']);
            $table->timestamps();
        });

        Schema::create('copy_language', function (Blueprint $table) {
            $table->integer('language_id')->unsigned();
            $table->integer('copy_id')->unsigned();

            $table->text('value')->nullable();

            $table->primary(['language_id', 'copy_id']);

            $table  ->foreign('language_id')
                    ->references('id')
                    ->on('languages')
                    ->onDelete('RESTRICT');
            $table  ->foreign('copy_id')
                    ->references('id')
                    ->on('copies')
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
        Schema::dropIfExists('copy_language');
        Schema::dropIfExists('copies');
    }
}
