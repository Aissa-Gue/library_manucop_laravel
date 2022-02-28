<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_subjects', function (Blueprint $table) {
            $table->foreignId('book_id')->references('id')->on('books');
            $table->foreignId('subject_id')->references('id')->on('subjects');
            $table->timestamps();
            $table->primary(['book_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_subjects');
    }
}
