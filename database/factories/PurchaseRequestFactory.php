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
            'purchase_request_number' => $this->faker->uuid,
            'purpose' => $this->faker->text(100),
            'fund_cluster' => $this->faker->word,
            'center_code' => $this->faker->word,
            'total_cost' => $this->faker->randomNumber,
            'pr_dir' => $this->faker->name,
            'end_user_id' => $this->faker->numberBetween(63, 128),
            'purchase_request_type' => $this->faker->word,
            'status' => "Pending",
            'pr_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'mode_of_procurement' => $this->faker->word,
            'uacs_code' => $this->faker->word,
            'charge_to' => $this->faker->word,
            'alloted_amount' => $this->faker->randomNumber,
            'sa_or' => $this->faker->name,
            // 'bac_task_id' => $this->faker->name,
            'requested_by_id' => $this->faker->numberBetween(1, 24),
            'approved_by_id' => $this->faker->numberBetween(1, 24),
            // 'process_complete_status' => ,
            // 'process_complete_date' => $this->faker->name,
            
        ];
    }
}
