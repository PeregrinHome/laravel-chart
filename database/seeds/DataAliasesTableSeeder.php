<?php

use Illuminate\Database\Seeder;
use App\TypeData;

class DataAliasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++){
            TypeData::firstOrCreate(['device_id' => 2, 'name' => 'Ток_'.$i, 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'current'.$i]);
            TypeData::firstOrCreate(['device_id' => 3, 'name' => 'Температура_'.$i, 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'temp'.$i]);
            TypeData::firstOrCreate(['device_id' => 4, 'name' => 'Мощность_'.$i, 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'power'.$i]);
        }
//        TypeData::firstOrCreate(['device_id' => 13, 'name' => 'Ток', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'current']);
//        TypeData::firstOrCreate(['device_id' => 13, 'name' => 'Температура', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'temp']);
//        TypeData::firstOrCreate(['device_id' => 13, 'name' => 'Мощность', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'alias' => 'power']);
    }
}
