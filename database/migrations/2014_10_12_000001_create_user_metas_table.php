<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('father_name')->nullable();
            $table->string('parent_phoneNumber')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('unit')->nullable();
            $table->unsignedBigInteger('grade_id')->index()->nullable();
            $table->timestamp('birthday')->nullable();
            $table->unsignedBigInteger('identifier_id')->index()->nullable();
            $table->string('identifying_code');
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
//            $table->foreign('identifier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_metas');
    }
}
