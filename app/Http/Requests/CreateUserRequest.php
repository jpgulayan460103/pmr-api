<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'password' => 'required',
            'type' => 'required',
            'section_id' => 'required',
            'cellphone_number' => 'required|digits:11',
            'email_address' => 'required|email',
        ];
    }
}
