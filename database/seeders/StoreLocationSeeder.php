<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storelocations')->insert([
        [
           'Storelocations' => 'Mandaluyong City'
        ],
        [
           'Storelocations'=> 'Makati City',
        ],
        [
            'Storelocations'=> 'Quezon City'
        ],
        [
            'Storelcations' => 'Pasay City',
        ],
            
        ]);
    }
}
