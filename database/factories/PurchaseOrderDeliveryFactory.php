<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderDeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'purchase_request_id' => $this->faker->randomDigit,
            'purchase_order_delivery_uuid' => $this->faker->uuid,
            'delivery_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'delivery_completion' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'delivery_receipt_dir' => $this->faker->randomDigit,
        ];
    }
}
