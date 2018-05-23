<?php

use Illuminate\Database\Seeder;
use App\LineTimeGraphic;

class LineTimeGraphicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        LineTimeGraphic::firstOrCreate(['name' => 'Линия 1.', 'color' => '#000', 'graphics_id' => 1, 'data_alias' => 'current1']);
//        LineTimeGraphic::firstOrCreate(['name' => 'Линия 2.', 'color' => '#555', 'graphics_id' => 1, 'data_alias' => 'temp1']);
//        LineTimeGraphic::firstOrCreate(['name' => 'Линия 3.', 'color' => '#888', 'graphics_id' => 1, 'data_alias' => 'power1']);
        LineTimeGraphic::firstOrCreate(['name' => 'Линия 1.', 'color' => '#888', 'graphics_id' => 1, 'data_alias' => 'Pervoe_ustrojstvo']);
        LineTimeGraphic::firstOrCreate(['name' => 'Линия 2.', 'color' => '#555', 'graphics_id' => 1, 'data_alias' => 'Pervoe_ustrojstvo']);
        LineTimeGraphic::firstOrCreate(['name' => 'Линия 3.', 'color' => '#333', 'graphics_id' => 1, 'data_alias' => 'Pervoe_ustrojstvo']);
    }
}
