<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_books', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answerOne');
            $table->string('answerTwo');
            $table->string('answerThree');
            $table->string('answerFour');
            $table->text('imageOne')->nullable();
            $table->text('imageTwo')->nullable();
            $table->text('imageThree')->nullable();
            $table->text('imageFour')->nullable();
            $table->string('True');
            $table->string('level')->nullable();
            $table->text('image')->nullable();
            $table->text('audio')->nullable();
            $table->string('testable_type')->nullable();
            $table->unsignedBigInteger('testable_id')->nullable();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('format')->default(1)->comment('از شماره ۱ تا ۴ برای انتخاب قالب');
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
        Schema::dropIfExists('exam_books');
    }
}
