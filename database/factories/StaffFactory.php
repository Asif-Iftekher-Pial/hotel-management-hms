<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' =>$this->faker->name(),
            'department_id' =>$this->faker->numberBetween($min = 1, $max = 10),
            'bio' =>$this->faker->text(),
            'salary_amt' =>$this->faker->randomNumber(3),
            'photo' =>$this->faker->imageUrl($width= 640, $height=480),
        ];
    }
}
