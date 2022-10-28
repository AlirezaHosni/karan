<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_question_samples', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('exam_question_sampleable_type')->nullable();
            $table->unsignedBigInteger('exam_question_sampleable_id')->nullable();
            $table->tinyInteger('type')->comment('۰ = تالیفی، ۱ = سراسری');
            $table->tinyInteger('period')->nullable()->comment('۰ = ترم اول، ۱ = ترم دوم، ۲ = کل کتاب');
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
        Schema::dropIfExists('exam_book_samples');
    }
}
