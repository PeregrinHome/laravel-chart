<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data', function (Blueprint $table) {

            $table->foreign('alias')
                ->references('alias')->on('data_aliases')
                ->onDelete('cascade');

            $table->foreign('device_id')
                ->references('id')->on('devices')
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
        Schema::table('data', function (Blueprint $table) {
            $table->dropForeign(['alias', 'device_id']);
        });
    }
}
