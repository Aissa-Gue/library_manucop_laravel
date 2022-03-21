<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscripts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->references('id')->on('books');
            $table->integer('book_part')->nullable();

            $table->string('trans_day')->nullable();
            //Hijri
            $table->integer('trans_day_nbr')->nullable();
            $table->integer('trans_month')->nullable();
            $table->integer('trans_syear')->nullable();
            $table->integer('trans_eyear')->nullable();
            //m => miladi
            $table->integer('trans_day_nbr_m')->nullable();
            $table->integer('trans_month_m')->nullable();
            $table->integer('trans_syear_m')->nullable();
            $table->integer('trans_eyear_m')->nullable();

            $table->string('trans_place')->nullable();
            $table->boolean('signed_in');//changed

            $table->foreignId('cabinet_id')->nullable()->references('id')->on('cabinets');
            $table->integer('nbr_in_cabinet')->nullable();
            $table->string('manu_type')->nullable();//type enum
            $table->integer('nbr_in_index')->nullable();//changed

            $table->string('font')->nullable();
            $table->string('font_style')->nullable();
            $table->boolean('regular_lines')->nullable();
            $table->string('lines_notes')->nullable();

            $table->integer('nbr_of_papers')->nullable();//added
            $table->integer('paper_size')->nullable();
            $table->string('size_notes')->nullable();//added

            $table->string('save_status')->nullable();//added حالة الحفظ
            $table->boolean('is_truncated')->nullable();//added التمام والبتر
            $table->string('truncation_notes')->nullable();//added ملاحظة حول مكان البتر

            $table->string('transcribed_from')->nullable();
            $table->string('transcribed_to')->nullable();

            $table->string('manuscript_level')->nullable();//changed
            $table->string('transcriber_level')->nullable();//changed

            $table->boolean('rost_completion')->nullable(); // ترميم وإتمام

            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities');

            $table->text('notes')->nullable();
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
        Schema::dropIfExists('manuscripts');
    }
}
