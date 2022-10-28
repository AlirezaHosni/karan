<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaranCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karan_competitions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('image')->nullable();
            $table->integer('karan_number');
            $table->unsignedBigInteger('grade_id')->index();
            $table->integer('time');
            $table->unsignedBigInteger('answer_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karan_competitions');
    }
}
