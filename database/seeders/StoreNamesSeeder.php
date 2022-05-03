<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
         [
            'Storename' => 'SM Megamall',
         ],
         [
            'Storename' => 'SM Makati City',
         ],   
         [
            'Storename' => 'SM North Edsa',
         ],
         [
            'Storename'=> 'SM Mall of Asia',
         ],   

        ]);
    }
}
