<?php

namespace App\Http\Requests;

use App\Rules\ValidCellphoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'address' => 'string|required',
            'name' => 'string|required',
            'categories' => 'required',
            'contacts.*.name' => 'required',
            'contacts.*.contact_number' => [
                'required',
                // 'digits:11',
                // new ValidCellphoneNumber
            ],
            'contacts.*.email_address' => 'required',
        ];
    }
}
