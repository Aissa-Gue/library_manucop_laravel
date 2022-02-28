<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptTranscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_transcribers', function (Blueprint $table) {
            $table->foreignId('manuscript_id')->references('id')->on('manuscripts');
            $table->foreignId('transcriber_id')->references('id')->on('transcribers');
            $table->string('name_in_manu');
            $table->timestamps();
            $table->primary(['manuscript_id','transcriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manuscript_transcribers');
    }
}
