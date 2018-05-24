<?php

use Illuminate\Database\Seeder;
use App\Data;
use Jenssegers\Date\Date;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * rand(5, 15)
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++){
//            Data::firstOrCreate(['device_id' => 1, 'value' => rand(5, 200), 'alias' => 'Tip_1', 'time' => (new Date(1519731325, new DateTimeZone('Europe/Moscow')))->add($i.' hour')->format('U')]);
            Data::firstOrCreate(['device_id' => 2, 'value' => rand(5, 200), 'alias' => 'current1', 'time' => (new Date(1519731325))->add($i.' hour')->format('U')]);
//            Data::firstOrCreate(['device_id' => 5, 'value' => rand(5, 200), 'alias' => 'current1']);
//            Data::firstOrCreate(['device_id' => 5, 'value' => rand(5, 200), 'alias' => 'temp1']);
//            Data::firstOrCreate(['device_id' => 5, 'value' => rand(5, 200), 'alias' => 'power1']);
        }
    }
}
