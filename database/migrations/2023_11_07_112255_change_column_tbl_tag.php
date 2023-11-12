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
        Schema::dropIfExists('tbl_tags');
    }

    public function down()
    {
        // Если вам понадобится откатить миграцию, вы можете определить метод down здесь.
    }
};
