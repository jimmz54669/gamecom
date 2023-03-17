<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameapps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gameappname');
            $table->string('gameapplink');
            $table->string('gamebehavior');
            $table->string('gamepic');
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
        Schema::dropIfExists('gameapps');
    }
}
