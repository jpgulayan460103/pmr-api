<?php

namespace App\Rules\RequisitionIssue;

use Illuminate\Contracts\Validation\Rule;

class MinIfHasStock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $has_stock_attribute = implode(".",[
            $exploded[0],
            $exploded[1],
            "has_stock"
        ]);
        return request($has_stock_attribute) == 1 && $value > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '1 is the minimum.';
    }
}
