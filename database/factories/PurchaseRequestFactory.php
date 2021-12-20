<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_request_uuid' => $this->faker->uuid,
            'code_uacs' => $this->faker->isbn10,
            'purchase_request_number' => $this->faker->randomDigit,
            'particulars' => $this->faker->text(100),
            'pr_dir' => $this->faker->word,
            'end_user' => $this->faker->name,
            'types' => $this->faker->word,
            'mode_of_procurement' => $this->faker->word,
        ];
    }
}
