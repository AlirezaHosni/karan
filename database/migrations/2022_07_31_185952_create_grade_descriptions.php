<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_descriptions', function (Blueprint $table) {
            $table->id();
            $table->text("description");
            $table->unsignedBigInteger("grade_id");
            $table->text("image");
            $table->unsignedBigInteger("selected_lesson_id")->index();
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
        Schema::dropIfExists('grades_descriptions');
    }
}
