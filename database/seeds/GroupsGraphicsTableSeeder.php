<?php

use Illuminate\Database\Seeder;
use App\GroupGraphic;

class GroupsGraphicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupGraphic::firstOrCreate(['name' => 'Группа 1', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать']);
        GroupGraphic::firstOrCreate(['name' => 'Группа 2', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать']);
        GroupGraphic::firstOrCreate(['name' => 'Группа 3', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать']);
    }
}
