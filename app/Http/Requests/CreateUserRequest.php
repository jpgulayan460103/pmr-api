<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AllowedStringName;
use App\Rules\ValidCellphoneNumber;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'firstname' => ['required', new AllowedStringName],
            'lastname' => ['required', new AllowedStringName],
            'middlename' => [new AllowedStringName],
            'password' => 'required',
            'type' => 'required',
            'section_id' => 'required',
            'cellphone_number' => ['required','digits:11', new ValidCellphoneNumber],
            'email_address' => 'required|email',
        ];
    }
}
