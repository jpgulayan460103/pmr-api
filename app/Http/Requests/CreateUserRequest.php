<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AllowedStringName;
use App\Rules\ValidCellphoneNumber;
use Illuminate\Validation\Rule;

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
            'username' => [
                'required',
                Rule::unique('users')->ignore(request('id'))
            ],
            'firstname' => ['required', new AllowedStringName],
            'lastname' => ['required', new AllowedStringName],
            'middlename' => [new AllowedStringName],
            'password' => 'required',
            'account_type' => 'required',
            'office_id' => 'required',
            'position_id' => 'required',
            'cellphone_number' => ['required','digits:11', new ValidCellphoneNumber],
            'email_address' => 'required|email',
        ];
    }
}
