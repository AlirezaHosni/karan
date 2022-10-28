<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('0 => student, 1 => teacher')->default(0);
            $table->unsignedBigInteger('lesson_id');
            $table->integer('first_term_price')->nullable();
            $table->integer('second_term_price')->nullable();
            $table->integer('year_price')->nullable();
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
        Schema::dropIfExists('subscription_sales');
    }
}
