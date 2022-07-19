<?php

namespace Database\Factories;

use App\Models\SMSApi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SMSApiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     *
     * @return string
     */
    protected $model = SMSApi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barcode_number' => '9' . rand(000000000000000000,999999999999999999)
        ];
    }
}
