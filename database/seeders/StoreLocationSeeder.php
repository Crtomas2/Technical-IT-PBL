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
           'Storelocations' => 'EDSA, corner Doña Julia Vargas Ave, Ortigas Center, Mandaluyong, 1555 Metro Manila'
        ],
        [
           'Storelocations'=> 'SM Makati, Courtyard Dr, Makati, 1223 Metro Manila'
        ],
        [
            'Storelocations'=> 'SM North EDSA, North Avenue, corner Epifanio de los Santos Ave, Bagong Pag-asa, Quezon City, 1105 Metro Manila'
        ],
        [
            'Storelcations' => 'SM Mall of Asia, Pasay, Metro Manila',
        ],
            
        ]);
    }
}
