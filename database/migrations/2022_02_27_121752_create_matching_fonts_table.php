<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchingFontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matching_fonts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->references('id')->on('manuscripts');
            $table->foreignId('transcriber_id')->references('id')->on('transcribers');
            $table->foreignId('transcriber_id2')->references('id')->on('transcribers');
            $table->timestamps();
            $table->unique(['transcriber_id', 'transcriber_id2', 'manuscript_id'], 'matching_fonts_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matching_fonts');
    }
}