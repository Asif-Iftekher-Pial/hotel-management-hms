<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffPayment>
 */
class StaffPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'staff_id' =>$this->faker->numberBetween($min = 1, $max = 20),
            'amount' =>$this->faker->randomNumber(5),
            'payment_date' =>$this->faker->date()
        ];
    }
}
