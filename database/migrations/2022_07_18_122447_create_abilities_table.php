<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // @guigui
            $table->tinyInteger('developper');
            $table->tinyInteger('ui_ux');
            $table->tinyInteger('maker');
            $table->tinyInteger('management');
            $table->tinyInteger('commercial');
            $table->tinyInteger('communication');
            $table->tinyInteger('ops');
            $table->tinyInteger('design_graphic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abilities');
    }
};
