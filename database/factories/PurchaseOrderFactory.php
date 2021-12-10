<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_order_uuid' => $this->faker->uuid,
            'purchase_order_number' => $this->faker->randomDigit,
            'purchase_order_dir' => $this->faker->word,
            'name_of_supplier' => $this->faker->name,
            'iar_dir' => $this->faker->randomDigit,
            'receipt_dir' => $this->faker->word(),
            'receipt_number' => $this->faker->randomDigit(),
            'type_of_equipment' => $this->faker->word(),
            'attendance' => $this->faker->word(),
            'certificate_of_acceptance' => $this->faker->word(),
            'certificate_of_occupancy' => $this->faker->word(),
            'certificate_of_completion' => $this->faker->word(),
        ];
    }
}
