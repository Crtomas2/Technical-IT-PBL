<?php

namespace Database\Seeders;

use App\Models\SMSApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SMSApi::create([
            'barcode_number'=> '000000000'
        ]);
    }
}
