<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code')->unique();
            $table->tinyInteger('percent')->default(0);
            $table->tinyInteger('type')->comment('0 => disposable, 1 => festival, 2 => identifier, 3 => planExam');
            $table->tinyInteger('is_used')->default(0)->comment('0 => not used, 1 => used');
            $table->timestamp('discount_start_date')->nullable();
            $table->timestamp('discount_end_date')->nullable();
            $table->timestamp('using_period_start_date')->nullable();
            $table->timestamp('using_period_end_date')->nullable();
            $table->unsignedBigInteger('identifier_id')->nullable();
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
        Schema::dropIfExists('discounts');
    }
}
