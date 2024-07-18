<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('sex'); // 0: Male, 1: Female
            $table->string('breed')->nullable(); // 品種
            $table->text('self_introduction')->nullable();
            $table->string('img_name')->nullable();
            $table->unsignedBigInteger('user_id'); // 保護者のID
            $table->string('email')->unique(); // メールアドレス
            $table->string('password'); // パスワード
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cats');
    }
}
