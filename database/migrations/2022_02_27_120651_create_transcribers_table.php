<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcribers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->unique();
            $table->string('descent1')->nullable();
            $table->string('descent2')->nullable();
            $table->string('descent3')->nullable();
            $table->string('descent4')->nullable();
            $table->string('descent5')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('other_name1')->nullable();
            $table->string('other_name2')->nullable();
            $table->string('other_name3')->nullable();
            $table->string('other_name4')->nullable();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities');
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
        Schema::dropIfExists('transcribers');
    }
}