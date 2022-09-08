<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' =>$this->faker->numberBetween($min = 1, $max = 20),
            'room_id' =>$this->faker->numberBetween($min = 1, $max = 20),
            'checkin' =>$this->faker->date(),
            'checkout' =>$this->faker->date(),
            'total_adults' =>$this->faker->numberBetween($min = 1, $max = 8),
            'total_children' =>$this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
