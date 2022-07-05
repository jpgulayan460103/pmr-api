<?php

namespace App\Http\Requests;

use App\Repositories\LibraryRepository;
use App\Repositories\RequisitionIssueRepository;
use App\Rules\LibraryExistRule;
use App\Rules\MaxInt;
use App\Rules\MaxQuantity;
use App\Transformers\FormProcessTransformer;
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
                new MaxInt,
            ],
            'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'from_ppmp' => ['required'],
            'requested_by_name' => ['required', 'string'],
            'requested_by_id' => ['required', new LibraryExistRule('user_section_signatory')],
            'approved_by_name' => ['required', 'string'],
            'approved_by_id' => ['required', new LibraryExistRule('user_section_signatory')],
        ];
    }

    public function messages()
    {
        return [
            'items.*.request_quantity.required' => 'Required',
            'items.*.request_quantity.integer' => 'Invalid format',
            'items.*.request_quantity.min' => 'Invalid quantity',
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
            if(request()->has('purpose')){
                if(trim(request('purpose')) == "For the implementation of"){
                    $validator->errors()->add("purpose", "The purpose field is required.");
                }
            } 
        });
    }
}
