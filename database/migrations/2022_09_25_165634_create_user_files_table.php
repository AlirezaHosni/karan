<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('file')->nullable();
            $table->tinyInteger('section')->comment('۰ = ارتباط با ما، ۱ = فایل‌های ذخیره شده');
            $table->tinyInteger('type')->comment('۰ = فایل ارسالی،۱ - انتقادات، ۲ = پیشنهادات،۳ = سوالات مطرح شده');
            $table->tinyInteger('format')->comment('۰ = صوتی،۱ - متنی،۲ = تصویری');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_files');
    }
}
