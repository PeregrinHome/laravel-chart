<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToMainGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites_time_graphics', function (Blueprint $table) {
            $table->foreign('time_graphic_id')
                ->references('id')->on('time_graphics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorites_time_graphics', function (Blueprint $table) {
            $table->dropForeign(['time_graphic_id']);
        });
    }
}
