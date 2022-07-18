<?php

namespace Database\Seeders;

use App\Models\SMSApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SMSApi::factory()->count(20)->create();
    }
}
