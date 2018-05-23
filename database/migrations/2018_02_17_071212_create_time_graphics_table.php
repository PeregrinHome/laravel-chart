<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_graphics', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->text('description')->nullable();
            $table->char('alias', 100);
            $table->integer('user_id')->unsigned();
            $table->integer('border_time')->default(0);
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
        Schema::dropIfExists('time_graphics');
    }
}
