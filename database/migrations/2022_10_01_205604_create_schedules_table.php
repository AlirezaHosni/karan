<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->tinyInteger('type')->default(0)->comment('۰ = مطالعه، ۱ = مطالعه و حل سوال تشریحی، ۲ = حل سوال تشریحی، ۳ = مطالعه و حل تست، ۴ = حل تست، ۵ = آزمون');
            $table->text('description')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->unsignedBigInteger('topic_id')->index();
//            $table->boolean('isChecked')->default(false);
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
