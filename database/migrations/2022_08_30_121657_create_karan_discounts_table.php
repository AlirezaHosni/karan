<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaranDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karan_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code')->unique()->nullable();
            $table->tinyInteger('percent')->default(0);
            $table->tinyInteger('karan')->comment('from 1 to 8')->default(0);
            $table->timestamp('discount_start_date')->nullable();
            $table->timestamp('discount_end_date')->nullable();
            $table->timestamp('using_period_start_date')->nullable();
            $table->timestamp('using_period_end_date')->nullable();
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
        Schema::dropIfExists('karan_discounts');
    }
}
