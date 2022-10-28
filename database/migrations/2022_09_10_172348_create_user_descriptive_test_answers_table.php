<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDescriptiveTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_descriptive_test_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id')->index();
            $table->unsignedBigInteger('user_exam_answer_id')->index();
            $table->integer('answer')->nullable();
            $table->integer('score')->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('test_id')->references('id')->on('descriptive_tests')->onDelete('cascade');
//            $table->foreign('user_exam_answer_id')->references('id')->on('user_exam_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('create_user_test_answers');
    }
}
