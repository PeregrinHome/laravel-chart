<?php

use Illuminate\Database\Seeder;
use App\TimeGraphic;

class TimeGraphicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++){
            TimeGraphic::firstOrCreate(['name' => 'График '.$i, 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать', 'alias' => 'graph'.$i, 'user_id' => 1]);
        }
//        TimeGraphic::firstOrCreate(['name' => 'График 1', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать', 'alias' => 'graph', 'user_id' => 1]);

    }
}
