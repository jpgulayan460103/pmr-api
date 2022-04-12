<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Library;

class LibraryExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $library_type;
    public function __construct($library_type)
    {
        $this->library_type = $library_type;
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
        $count = Library::where('library_type',$this->library_type)->where('id',$value)->select('id')->count();
        return $count != 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected value does not exist in the database.';
    }
}
