<?php

use Illuminate\Database\Seeder;
use App\Access;

class AccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::firstOrCreate(['access' => 1, 'name' => 'Админ']);
        Access::firstOrCreate(['access' => 2, 'name' => 'Пользователь']);
        Access::firstOrCreate(['access' => 3, 'name' => 'Гость']);
    }
}
