<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->year . ' ' . $this->faker->randomElement(['Toyota Corolla', 'Honda Civic', 'BMW 3 Series', 'Ford Mustang']),
            'price' => $this->faker->numberBetween(10000, 60000),
            'mileage' => $this->faker->numberBetween(5000, 120000),
            'image_url' => 'https://via.placeholder.com/300x180?text=' . urlencode($this->faker->randomElement(['Toyota', 'Honda', 'BMW', 'Ford'])),
        ];
    }
}
