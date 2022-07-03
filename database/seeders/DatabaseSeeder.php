<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     
        $this->call([
          StoreLocationSeeder::class,
          StoreNamesSeeder::class 
        ]);
        $this->call([
          LocationCodeSeeder::class,
        ]);
        $this->call([
          StoreGroupSeeder::class,
        ]);
        // $this->call([
        //   SmSSeeder::class,
        // ]);


       
    }
}
