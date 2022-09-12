<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>$this->faker->unique()->sentence(),
            'room_service_id'=>$this->faker->numberBetween($min = 1, $max = 5),
            'photo' =>$this->faker->imageUrl($width= 640, $height=480),
            'price'=>$this->faker->randomNumber(4),
            'size'=>$this->faker->numberBetween($min = 20, $max = 30),
            'room_type_id' =>$this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
