<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\AllowedStringName;
use App\Rules\LibraryExistRule;
use App\Rules\ValidCellphoneNumber;

class UpdateUserRequest extends FormRequest
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
            'office_id' => ['required', new LibraryExistRule('user_section')],
            'position_id' => ['required', new LibraryExistRule('user_position')],
            'cellphone_number' => ['required','digits:11', new ValidCellphoneNumber],
            'email_address' => 'required|email',
        ];
    }
}
