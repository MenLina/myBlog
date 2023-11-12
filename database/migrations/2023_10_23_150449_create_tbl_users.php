<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    */
    public function up(): void
    {
        Schema::create('tbl_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('status');
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('author_id');
            $table->string('image')->default('default.jpg')->nullable();
            $table->timestamps();

//            $table->index('tag_id', 'post_tag_idx');
//            $table->foreign('tag_id','post_tag_fk')->on('tbl_tags')->references('id');

            $table->index('author_id', 'author_id_idx');
            $table->foreign('author_id','author_id_fk')->on('users')->references('id');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('tbl_posts');
    }
};
