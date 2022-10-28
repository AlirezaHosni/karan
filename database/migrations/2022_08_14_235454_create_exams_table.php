<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->tinyInteger('section')->comment('۰ = آزمون برنامه‌ای، ۱ = آزمون انتخابی');
            $table->tinyInteger('questionFormat')->comment('۰ = تستی، ۱ = تشریحی');
            $table->tinyInteger('type')->nullable()->comment('۰ = تعیین سطح، ۱ = تیرماه، ۲ = دی‌ماه');
            $table->tinyInteger('scheduling')->nullable()->comment('۰ = هفتگی آنلاین، ۱ = دو هفته آنلاین، آفلاین(تعیین سطح)');
            $table->tinyInteger('level')->nullable()->comment('۰ = آسان، ۱ = متوسط، سخت = ۲');
            $table->tinyInteger('period')->nullable()->comment('۰ = ترم اول، ۱ = ترم دوم، ۲ = کل کتاب، ۳ = دوازدهم ترم + اول دهم، ۴ = دوازدهم + ترم اول یازدهم، ۵ = هر سه پایه همزمان');
            $table->string('examable_type');
            $table->unsignedBigInteger('examable_id');
            $table->time('suggestedTime')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->text('answerSheet')->nullable();
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
        Schema::dropIfExists('exams');
    }
}
