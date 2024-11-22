<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manga_id'); // Khóa ngoại liên kết với bảng manga
            $table->unsignedBigInteger('reply_to')->nullable()->after('id');
            $table->unsignedBigInteger('user_id'); // ID người dùng thực hiện bình luận (nếu có hệ thống user)
            $table->text('content'); // Nội dung bình luận
            $table->timestamps();

            // Thiết lập khóa ngoại liên kết với bảng manga
            $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
            $table->foreign('reply_to')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Nếu có bảng users
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
