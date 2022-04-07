<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptManutypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_manutypes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->references('id')->on('manuscripts');
            $table->foreignId('manutype_id')->references('id')->on('manutypes');
            $table->timestamps();
            $table->unique(['manuscript_id', 'manutype_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manuscript_manutypes');
    }
}