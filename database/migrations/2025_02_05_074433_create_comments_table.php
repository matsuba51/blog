<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body')->nullable();
            $table->text('content')->nullable();  // デフォルト値を空文字に設定
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ユーザーが削除されたらコメントも削除
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');  // ブログが削除されたらコメントも削除
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('comments'); // 正しく `dropIfExists` のみを記述
    }
};
