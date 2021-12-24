<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseRequest extends FormRequest
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
            'end_user_id' => 'required', 
            'pr_date' => 'date|required',
            'purpose' => 'required',
            'items.*.item_name' => 'required',
            'items.*.unit_of_measure_id' => 'required',
            'items.*.quantity' => 'numeric|min:1',
            'items.*.unit_cost' => ['numeric','min:0','regex:/^\d{1,15}(\.\d{1,2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'end_user_id.required' => 'The office/section is required.',
            'pr_date.required' => 'Date is required',
            'pr_date.date' => 'Not a valid date.',
            'items.*.unit_of_measure_id.required' => 'Required',
            'items.*.item_name.required' => 'Required',
            'items.*.quantity.min' => ':min is the minimum',
            'items.*.quantity.numeric' => 'Required',
            'items.*.unit_cost.min' => ':min is the minimum',
            'items.*.unit_cost.numeric' => 'Required',
            'items.*.unit_cost.regex' => '2 decimal places only',
        ];
    }
}
