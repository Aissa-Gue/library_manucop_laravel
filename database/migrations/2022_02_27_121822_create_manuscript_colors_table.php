<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->references('id')->on('manuscripts');
            $table->foreignId('color_id')->references('id')->on('colors');
            $table->timestamps();
            $table->unique(['manuscript_id', 'color_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manuscript_colors');
    }
}