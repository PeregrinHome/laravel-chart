<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToLineTimeGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_time_graphics', function (Blueprint $table) {
            $table->foreign('data_alias')
                ->references('alias')->on('data_aliases')
                ->onDelete('cascade');

            $table->foreign('graphics_id')
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
        Schema::table('line_time_graphics', function (Blueprint $table) {
            $table->dropForeign(['data_alias', 'device_id']);
        });
    }
}
