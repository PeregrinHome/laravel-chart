<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineTimeGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_time_graphics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('data_alias', 100);
            $table->char('color', 50);
            $table->integer('graphics_id')->unsigned();
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
        Schema::dropIfExists('line_time_graphics');
    }
}
