<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('teacher_id')->index();
            $table->unsignedBigInteger('session_id')->index();
            $table->integer('expert')->comment('بار علمی')->nullable();
            $table->integer('teaching_method')->comment('شیوه تدریس')->nullable();
            $table->integer('complete_teaching')->comment('تدریس کامل')->nullable();
            $table->integer('question_answering_method')->comment('روش حل سوال')->nullable();
            $table->integer('visual_communication')->comment('ارتباط بررسی')->nullable();
            $table->integer('average')->nullable();
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
        Schema::dropIfExists('rates');
    }
}
