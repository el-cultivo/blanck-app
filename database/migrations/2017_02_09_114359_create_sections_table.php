<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectiontypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->text('description');
            $table->string('view');
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('index');

            $table->integer('sectiontype_id')->unsigned();

            $table  ->foreign('sectiontype_id')
                    ->references('id')
                    ->on('sectiontypes')
                    ->onDelete('RESTRICT');

            $table->timestamps();
        });

        Schema::create('page_section', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
            $table->integer('section_id')->unsigned();

            $table->integer('order');

            $table->primary(['page_id', 'section_id']);

            $table  ->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onDelete('RESTRICT');
            $table  ->foreign('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('RESTRICT');

            $table->timestamps();
        });

        Schema::create('component_section', function (Blueprint $table) {
            $table->integer('component_id')->unsigned();
            $table->integer('section_id')->unsigned();

            $table->primary(['component_id', 'section_id']);

            $table  ->foreign('component_id')
                    ->references('id')
                    ->on('components')
                    ->onDelete('RESTRICT');
            $table  ->foreign('section_id')
                    ->references('id')
                    ->on('sections')
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
        Schema::dropIfExists('component_section');
        Schema::dropIfExists('page_section');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('sectiontypes');
    }
}
