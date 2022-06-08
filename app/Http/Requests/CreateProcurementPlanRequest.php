<?php

namespace App\Http\Requests;

use App\Models\Library;
use App\Models\ProcurementPlan;
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
            'prepared_by_name' => 'required|string',
            'prepared_by_position' => 'required|string',
            'certified_by_name' => 'required|string',
            'certified_by_position' => 'required|string',
            'approved_by_name' => 'required|string',
            'approved_by_position' => 'required|string',
            'title' => 'required',
            'procurement_plan_type_id' => ['required', new LibraryExistRule('procurement_plan_type')],
            'item_type_id' => 'required',
            'calendar_year' => 'required|digits:4|integer|min:'.date('Y').'|max:'.(date('Y')+1),
            'ppmp_date' => 'required|date',
            'approvedBy' => 'required',
            // 'items.*.item_id' => 'required',
            // 'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'items.*.total_quantity' => 'numeric|min:1',
            'items.*.item_id' => 'required',
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
            'items.*.item_id.required' => 'Please select an item.',
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateItems($validator);
            $this->validateProcurementType($validator);
        });
    }

    public function validateItems($validator)
    {
        if(request()->has('items')){
            if(request('items') == array()){
                $validator->errors()->add("items", "No items added.");
            }
        }
    }

    public function validateProcurementType($validator)
    {
        $ppmp = Library::where('library_type', 'procurement_plan_type')->where('name', ppmpValue())->first();
        $supplementalPpmp = Library::where('library_type', 'procurement_plan_type')->where('name', supplementalPpmpValue())->first();
        $existing_ppmp = ProcurementPlan::where('end_user_id', request('end_user_id'))
        ->where('calendar_year', request('calendar_year'))
        ->where('procurement_plan_type_id', $ppmp->id)
        ->count();
        if($ppmp->id == request('procurement_plan_type_id') && $existing_ppmp >= 1){
            $validator->errors()->add("procurement_plan_type_id", "PPMP of CY ".request('calendar_year')." is already created.");
        }elseif ($supplementalPpmp->id == request('procurement_plan_type_id') && $existing_ppmp == 0) {
            $validator->errors()->add("procurement_plan_type_id", "No PPMP of CY ".request('calendar_year')." created.");
        }
    }
}
