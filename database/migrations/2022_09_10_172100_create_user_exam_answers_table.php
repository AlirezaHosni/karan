<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->decimal('score', 5, 3, true)->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_answers');
    }
}
