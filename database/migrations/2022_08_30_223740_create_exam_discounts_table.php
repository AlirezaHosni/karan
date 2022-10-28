<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_discounts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('discount_percent')->default(0);
//            $table->tinyInteger('type')->comment('0 => disposable, 1 => festival, 2 => identifier, 3 => planExam');
            $table->timestamp('discount_start_date');
            $table->timestamp('discount_end_date');
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('exam_discounts');
    }
}
