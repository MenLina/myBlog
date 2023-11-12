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
        Schema::table('tbl_posts', function (Blueprint $table) {
            $table->string('tag', 255)->after('tag_id');
            $table->dropColumn('tag_id');
        });
    }

    public function down()
    {
        Schema::table('tbl_posts', function (Blueprint $table) {
            $table->dropColumn('tag');
            $table->integer('tag_id');
        });
    }
};
