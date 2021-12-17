<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'firstname' => $this->faker->name(),
            'middlename' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'user_dn' => $this->faker->name(),
        ];
    }
}
