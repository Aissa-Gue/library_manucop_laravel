<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptMotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_motifs', function (Blueprint $table) {
            $table->foreignId('manuscript_id')->references('id')->on('manuscripts');
            $table->foreignId('motif_id')->references('id')->on('motifs');
            $table->timestamps();
            $table->primary(['manuscript_id','motif_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manuscript_motifs');
    }
}
