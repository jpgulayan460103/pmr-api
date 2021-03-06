<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxQuantity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $quantity;
    public function __construct($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exploded = explode(".", $attribute);
        $quantity_attribute = implode(".",[
            $exploded[0],
            $exploded[1],
            $this->quantity
        ]);

        return $value <= request($quantity_attribute);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid quantity';
    }
}
