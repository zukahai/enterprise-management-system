<?php

namespace Database\Factories;

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
            'id_custom' => fake()->numberBetween(100000,999999),
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'contact' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'note' => fake()->text(),
            'mst' => fake()->numberBetween(100000,999999),
        ];
    }
}
