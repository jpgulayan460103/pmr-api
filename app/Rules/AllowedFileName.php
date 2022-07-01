<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowedFileName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $messageString;
    public function __construct($messageString = "")
    {
        $this->messageString = $messageString;
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
        if(trim($value) == ""){
            return true;
        }
        return preg_match('/^[\pL\pM_ _-_-_.0-9]+$/u', $value) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->messageString != ""){
            return $this->messageString;
        }
        return 'The :attribute field contains invalid characters.';
    }
}
