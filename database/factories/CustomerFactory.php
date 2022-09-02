<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'full_name' =>$this->faker->name(),
            'email' =>$this->faker->unique()->email(),
            'password' => Hash::make('12345'),
            'mobile' =>$this->faker->phoneNumber,
            'address' =>$this->faker->address,
            'photo' =>$this->faker->imageUrl($width= 640, $height=480, 'cats'),
        ];
    }
}
