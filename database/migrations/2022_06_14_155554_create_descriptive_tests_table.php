<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptiveTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptive_tests', function (Blueprint $table) {
            $table->id();
            $table->string('question')->nullable();
            $table->string('level')->nullable();
            $table->text('image')->nullable();
//            $table->text('audio')->nullable();
//            $table->string('testable_type')->nullable();
//            $table->unsignedBigInteger('testable_id')->nullable();
            $table->unsignedBigInteger('exam_id')->nullable();
//            $table->tinyInteger('format')->default(1)->comment('از شماره ۱ تا ۴ برای انتخاب قالب');
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
        Schema::dropIfExists('descriptive_tests');
    }
}
