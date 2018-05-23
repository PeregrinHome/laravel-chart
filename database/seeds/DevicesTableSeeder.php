<?php

use Illuminate\Database\Seeder;
use App\Device;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 200; $i++){
            Device::firstOrCreate(['user_id' => 1, 'name' => 'Device_'.$i, 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'token' => '346v346b43b63463636b346b346b36'.$i]);
        }
//        Device::destroy(1);
//        Device::firstOrCreate(['user_id' => 1, 'name' => 'Device_1', 'description' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке.', 'token' => '346v346b43b63463636b346b346b36']);
    }
}
