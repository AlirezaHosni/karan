<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaranCompetitionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karan_competition_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karan_competition_id')->index();
            $table->text('answer');
            $table->text('image')->nullable();
            $table->tinyInteger('is_true');
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
        Schema::dropIfExists('karan_competition_answers');
    }
}
