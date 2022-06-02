<?php

namespace App\Http\Requests;

use App\Rules\LibraryExistRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProcurementPlanRequest extends FormRequest
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
            // 'pr_date' => 'date|required',
            // 'procurement_plan_type' => 'required',
            // 'items.*.item_name' => 'required',
            // 'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'items.*.total_quantity' => 'numeric|min:1',
            'items.*.mon1' => 'required|numeric|min:0',
            'items.*.mon2' => 'required|numeric|min:0',
            'items.*.mon3' => 'required|numeric|min:0',
            'items.*.mon4' => 'required|numeric|min:0',
            'items.*.mon5' => 'required|numeric|min:0',
            'items.*.mon6' => 'required|numeric|min:0',
            'items.*.mon7' => 'required|numeric|min:0',
            'items.*.mon8' => 'required|numeric|min:0',
            'items.*.mon9' => 'required|numeric|min:0',
            'items.*.mon10' => 'required|numeric|min:0',
            'items.*.mon11' => 'required|numeric|min:0',
            'items.*.mon12' => 'required|numeric|min:0',
            'items.*.price' => ['numeric','min:0.01','regex:/^\d{1,15}(\.\d{1,2})?$/'],
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
            'items.*.mon1.min' => ':min is the minimum',
            'items.*.mon1.numeric' => 'Required',
            'items.*.mon2.min' => ':min is the minimum',
            'items.*.mon2.numeric' => 'Required',
            'items.*.mon3.min' => ':min is the minimum',
            'items.*.mon3.numeric' => 'Required',
            'items.*.mon4.min' => ':min is the minimum',
            'items.*.mon4.numeric' => 'Required',
            'items.*.mon5.min' => ':min is the minimum',
            'items.*.mon5.numeric' => 'Required',
            'items.*.mon6.min' => ':min is the minimum',
            'items.*.mon6.numeric' => 'Required',
            'items.*.mon7.min' => ':min is the minimum',
            'items.*.mon7.numeric' => 'Required',
            'items.*.mon8.min' => ':min is the minimum',
            'items.*.mon8.numeric' => 'Required',
            'items.*.mon9.min' => ':min is the minimum',
            'items.*.mon9.numeric' => 'Required',
            'items.*.mon10.min' => ':min is the minimum',
            'items.*.mon10.numeric' => 'Required',
            'items.*.mon11.min' => ':min is the minimum',
            'items.*.mon11.numeric' => 'Required',
            'items.*.mon12.min' => ':min is the minimum',
            'items.*.mon12.numeric' => 'Required',
            'items.*.price.min' => ':min is the minimum',
            'items.*.price.numeric' => 'Required',
            'items.*.price.regex' => '2 decimal places only',
            'items.*.total_quantity.min' => ':min is the minimum',
            'items.*.total_quantity.numeric' => 'Required',
        ];
    }
}
