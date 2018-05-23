<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(AccessesTableSeeder::class);

        // На этом этапе регистрация пользователя, а только потом остальные сиды

//        $this->call(DevicesTableSeeder::class);
//        $this->call(DataAliasesTableSeeder::class);
        $this->call(DataTableSeeder::class);

//        $this->call(GroupsGraphicsTableSeeder::class);

//        $this->call(TimeGraphicsTableSeeder::class);
//        $this->call(LineTimeGraphicsTableSeeder::class);


    }
}
