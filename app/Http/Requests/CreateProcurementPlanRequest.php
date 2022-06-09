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
            // 'itemsA.*.item_id' => 'required',
            // 'itemsA.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'itemsA.*.total_quantity' => 'numeric|min:1',
            'itemsA.*.item_id' => 'required',
            'itemsA.*.mon1' => 'required|numeric|min:0',
            'itemsA.*.mon2' => 'required|numeric|min:0',
            'itemsA.*.mon3' => 'required|numeric|min:0',
            'itemsA.*.mon4' => 'required|numeric|min:0',
            'itemsA.*.mon5' => 'required|numeric|min:0',
            'itemsA.*.mon6' => 'required|numeric|min:0',
            'itemsA.*.mon7' => 'required|numeric|min:0',
            'itemsA.*.mon8' => 'required|numeric|min:0',
            'itemsA.*.mon9' => 'required|numeric|min:0',
            'itemsA.*.mon10' => 'required|numeric|min:0',
            'itemsA.*.mon11' => 'required|numeric|min:0',
            'itemsA.*.mon12' => 'required|numeric|min:0',
            'itemsA.*.price' => ['numeric','min:0.01','regex:/^\d{1,15}(\.\d{1,2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'end_user_id.required' => 'The office/section is required.',
            'pr_date.required' => 'Date is required',
            'pr_date.date' => 'Not a valid date.',
            'itemsA.*.unit_of_measure_id.required' => 'Required',
            'itemsA.*.item_id.required' => 'Please select an item.',
            'itemsA.*.mon1.min' => ':min is the minimum',
            'itemsA.*.mon1.numeric' => 'Required',
            'itemsA.*.mon1.required' => 'Required',
            'itemsA.*.mon2.min' => ':min is the minimum',
            'itemsA.*.mon2.numeric' => 'Required',
            'itemsA.*.mon2.required' => 'Required',
            'itemsA.*.mon3.min' => ':min is the minimum',
            'itemsA.*.mon3.numeric' => 'Required',
            'itemsA.*.mon3.required' => 'Required',
            'itemsA.*.mon4.min' => ':min is the minimum',
            'itemsA.*.mon4.numeric' => 'Required',
            'itemsA.*.mon4.required' => 'Required',
            'itemsA.*.mon5.min' => ':min is the minimum',
            'itemsA.*.mon5.numeric' => 'Required',
            'itemsA.*.mon5.required' => 'Required',
            'itemsA.*.mon6.min' => ':min is the minimum',
            'itemsA.*.mon6.numeric' => 'Required',
            'itemsA.*.mon6.required' => 'Required',
            'itemsA.*.mon7.min' => ':min is the minimum',
            'itemsA.*.mon7.numeric' => 'Required',
            'itemsA.*.mon7.required' => 'Required',
            'itemsA.*.mon8.min' => ':min is the minimum',
            'itemsA.*.mon8.numeric' => 'Required',
            'itemsA.*.mon8.required' => 'Required',
            'itemsA.*.mon9.min' => ':min is the minimum',
            'itemsA.*.mon9.numeric' => 'Required',
            'itemsA.*.mon9.required' => 'Required',
            'itemsA.*.mon10.min' => ':min is the minimum',
            'itemsA.*.mon10.numeric' => 'Required',
            'itemsA.*.mon10.required' => 'Required',
            'itemsA.*.mon11.min' => ':min is the minimum',
            'itemsA.*.mon11.numeric' => 'Required',
            'itemsA.*.mon11.required' => 'Required',
            'itemsA.*.mon12.min' => ':min is the minimum',
            'itemsA.*.mon12.numeric' => 'Required',
            'itemsA.*.mon12.required' => 'Required',
            'itemsA.*.price.min' => ':min is the minimum',
            'itemsA.*.price.numeric' => 'Required',
            'itemsA.*.price.regex' => '2 decimal places only',
            'itemsA.*.total_quantity.min' => ':min is the minimum',
            'itemsA.*.total_quantity.numeric' => 'Required',

            'itemsB.*.unit_of_measure_id.required' => 'Required',
            'itemsB.*.item_id.required' => 'Please select an item.',
            'itemsB.*.mon1.min' => ':min is the minimum',
            'itemsB.*.mon1.numeric' => 'Required',
            'itemsB.*.mon1.required' => 'Required',
            'itemsB.*.mon2.min' => ':min is the minimum',
            'itemsB.*.mon2.numeric' => 'Required',
            'itemsB.*.mon2.required' => 'Required',
            'itemsB.*.mon3.min' => ':min is the minimum',
            'itemsB.*.mon3.numeric' => 'Required',
            'itemsB.*.mon3.required' => 'Required',
            'itemsB.*.mon4.min' => ':min is the minimum',
            'itemsB.*.mon4.numeric' => 'Required',
            'itemsB.*.mon4.required' => 'Required',
            'itemsB.*.mon5.min' => ':min is the minimum',
            'itemsB.*.mon5.numeric' => 'Required',
            'itemsB.*.mon5.required' => 'Required',
            'itemsB.*.mon6.min' => ':min is the minimum',
            'itemsB.*.mon6.numeric' => 'Required',
            'itemsB.*.mon6.required' => 'Required',
            'itemsB.*.mon7.min' => ':min is the minimum',
            'itemsB.*.mon7.numeric' => 'Required',
            'itemsB.*.mon7.required' => 'Required',
            'itemsB.*.mon8.min' => ':min is the minimum',
            'itemsB.*.mon8.numeric' => 'Required',
            'itemsB.*.mon8.required' => 'Required',
            'itemsB.*.mon9.min' => ':min is the minimum',
            'itemsB.*.mon9.numeric' => 'Required',
            'itemsB.*.mon9.required' => 'Required',
            'itemsB.*.mon10.min' => ':min is the minimum',
            'itemsB.*.mon10.numeric' => 'Required',
            'itemsB.*.mon10.required' => 'Required',
            'itemsB.*.mon11.min' => ':min is the minimum',
            'itemsB.*.mon11.numeric' => 'Required',
            'itemsB.*.mon11.required' => 'Required',
            'itemsB.*.mon12.min' => ':min is the minimum',
            'itemsB.*.mon12.numeric' => 'Required',
            'itemsB.*.mon12.required' => 'Required',
            'itemsB.*.price.min' => ':min is the minimum',
            'itemsB.*.price.numeric' => 'Required',
            'itemsB.*.price.regex' => '2 decimal places only',
            'itemsB.*.total_quantity.min' => ':min is the minimum',
            'itemsB.*.total_quantity.numeric' => 'Required',
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
        if(request()->has('itemsA')){
            if(request('itemsA') == array()){
                $validator->errors()->add("itemsA", "No items A added.");
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
