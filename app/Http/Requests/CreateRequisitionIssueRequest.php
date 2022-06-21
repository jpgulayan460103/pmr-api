<?php

namespace App\Http\Requests;

use App\Rules\LibraryExistRule;
use App\Rules\MaxQuantity;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequisitionIssueRequest extends FormRequest
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
            'items.*.description' => ['required', 'string'],
            'items.*.request_quantity' => [
                'required',
                'integer',
                'min:1',
                request('from_ppmp') == 1 ? new MaxQuantity("max_quantity") : "",
            ],
            'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'from_ppmp' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'items.*.request_quantity.required' => 'Required',
            'items.*.request_quantity.integer' => 'Invalid format',
            'items.*.request_quantity.min' => ':min is the minimum',
            'items.*.description.required' => 'Required',
            'items.*.description.string' => 'Must be a string',
            'items.*.unit_of_measure_id.required' => 'Required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(request()->has('items')){
                if(request('items') == array()){
                    $validator->errors()->add("items", "No items added.");
                }
            }         
        });
    }
}
