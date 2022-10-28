<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPackSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_pack_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->integer('grade_price')->nullable();
            $table->integer('lesson_price')->nullable();
            $table->integer('session_price')->nullable();
            $table->integer('flash_capacity')->nullable();
            $table->integer('flash_price')->nullable();
            $table->integer('dvd_capacity')->nullable();
            $table->integer('dvd_price')->nullable();
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
        Schema::dropIfExists('video_pack_sales');
    }
}
