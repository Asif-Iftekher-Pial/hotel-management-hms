<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomTypeImage>
 */
class RoomTypeImageFactory extends Factory
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
            'room_type_id' =>$this->faker->numberBetween($min = 1, $max = 10),
            'photo' =>$this->faker->imageUrl($width= 640, $height=480),
            'photo_title' =>$this->faker->unique()->sentence()
        ];
    }
}
