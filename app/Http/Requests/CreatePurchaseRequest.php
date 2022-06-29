<?php

namespace App\Http\Requests;

use App\Rules\LibraryExistRule;
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
            'end_user_id' => ['required', new LibraryExistRule('user_section')], 
            'pr_date' => 'date|required',
            'purpose' => 'required',
            'requested_by_name' => 'required',
            'requested_by_id' => 'required',
            'approved_by_name' => 'required',
            'approved_by_id' => 'required',
            'title' => 'required',
            'items.*.item_name' => 'required',
            'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'items.*.quantity' => 'numeric|min:1',
            'items.*.unit_cost' => ['numeric','min:0.01','regex:/^\d{1,15}(\.\d{1,2})?$/'],
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
            'items.*.quantity.min' => 'Invalid quantity',
            'items.*.quantity.numeric' => 'Required',
            'items.*.unit_cost.min' => 'Invalid amount',
            'items.*.unit_cost.numeric' => 'Required',
            'items.*.unit_cost.regex' => 'Invalid format',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(request()->has('items')){
                if(request('items') == array()){
                    $validator->errors()->add("items", "No purchase request items added.");
                }
            }
            if(request()->has('purpose')){
                if(trim(request('purpose')) == "For the implementation of undefined" || trim(request('purpose')) == "For the implementation of"){
                    $validator->errors()->add("purpose", "The purpose field is required.");
                }
            }            
        });
    }

}
