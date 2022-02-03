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
    public $item;
    public function __construct($item)
    {
        $this->item = $item;
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
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
