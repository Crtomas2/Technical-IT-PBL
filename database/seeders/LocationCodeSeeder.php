<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location_codes')->insert([
          [
            'LocationCode' => '15-0006',
          ],
          ['LocationCode' => '15-0013'],
          ['LocationCode' => '15-0014'],
          ['LocationCode' => '15-0205'],

        ]);
    }
}
