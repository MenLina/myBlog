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
        Schema::table('tbl_posts', function (Blueprint $table) {
            $table->string('image')->nullable()->default('default.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tbl_posts', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
