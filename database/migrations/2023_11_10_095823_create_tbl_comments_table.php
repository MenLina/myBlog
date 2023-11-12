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
        Schema::create('tbl_comments', function (Blueprint $table) {

                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('post_id');
                $table->string('author')->nullable();
                $table->string('email')->nullable();
                $table->text('content');
                $table->string('status');
                $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('tbl_posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_comments');
    }
};
