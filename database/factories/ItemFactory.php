<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_name' => $this->faker->name,
            'item_code' => $this->faker->ean8,
            'unit_of_measure_id' => $this->faker->numberBetween(1,20),
            'item_category_id' => $this->faker->numberBetween(1,24),
        ];
    }
}
