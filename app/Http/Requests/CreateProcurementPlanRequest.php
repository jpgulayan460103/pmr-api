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
            'prepared_by_designation' => 'required|string',
            'certified_by_name' => 'required|string',
            'certified_by_designation' => 'required|string',
            'approved_by_name' => 'required|string',
            'approved_by_designation' => 'required|string',
            'title' => 'required',
            'procurement_plan_type_id' => ['required', new LibraryExistRule('procurement_plan_type')],
            'item_type_id' => 'required',
            'calendar_year' => 'required|digits:4|integer|min:'.date('Y').'|max:'.(date('Y')+1),
            'ppmp_date' => 'required|date',
            // 'itemsA.*.item_id' => 'required',
            // 'itemsA.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'itemsA.*.total_quantity' => 'integer|min:1',
            'itemsA.*.item_id' => 'required',
            'itemsA.*.mon1' => 'required|integer|min:0',
            'itemsA.*.mon2' => 'required|integer|min:0',
            'itemsA.*.mon3' => 'required|integer|min:0',
            'itemsA.*.mon4' => 'required|integer|min:0',
            'itemsA.*.mon5' => 'required|integer|min:0',
            'itemsA.*.mon6' => 'required|integer|min:0',
            'itemsA.*.mon7' => 'required|integer|min:0',
            'itemsA.*.mon8' => 'required|integer|min:0',
            'itemsA.*.mon9' => 'required|integer|min:0',
            'itemsA.*.mon10' => 'required|integer|min:0',
            'itemsA.*.mon11' => 'required|integer|min:0',
            'itemsA.*.mon12' => 'required|integer|min:0',
            'itemsA.*.price' => ['numeric','min:0','regex:/^\d{1,15}(\.\d{1,2})?$/'],
            'itemsB.*.total_quantity' => 'numeric|min:1',
            'itemsB.*.description' => 'required|string',
            'itemsB.*.mon1' => 'required|integer|min:0',
            'itemsB.*.mon2' => 'required|integer|min:0',
            'itemsB.*.mon3' => 'required|integer|min:0',
            'itemsB.*.mon4' => 'required|integer|min:0',
            'itemsB.*.mon5' => 'required|integer|min:0',
            'itemsB.*.mon6' => 'required|integer|min:0',
            'itemsB.*.mon7' => 'required|integer|min:0',
            'itemsB.*.mon8' => 'required|integer|min:0',
            'itemsB.*.mon9' => 'required|integer|min:0',
            'itemsB.*.mon10' => 'required|integer|min:0',
            'itemsB.*.mon11' => 'required|integer|min:0',
            'itemsB.*.mon12' => 'required|integer|min:0',
            'itemsB.*.price' => ['numeric','min:0.01','regex:/^\d{1,15}(\.\d{1,2})?$/'],
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
            'itemsA.*.mon1.min' => 'Invalid quantity',
            'itemsA.*.mon1.integer' => 'Invalid format',
            'itemsA.*.mon1.required' => 'Required',
            'itemsA.*.mon2.min' => 'Invalid quantity',
            'itemsA.*.mon2.integer' => 'Invalid format',
            'itemsA.*.mon2.required' => 'Required',
            'itemsA.*.mon3.min' => 'Invalid quantity',
            'itemsA.*.mon3.integer' => 'Invalid format',
            'itemsA.*.mon3.required' => 'Required',
            'itemsA.*.mon4.min' => 'Invalid quantity',
            'itemsA.*.mon4.integer' => 'Invalid format',
            'itemsA.*.mon4.required' => 'Required',
            'itemsA.*.mon5.min' => 'Invalid quantity',
            'itemsA.*.mon5.integer' => 'Invalid format',
            'itemsA.*.mon5.required' => 'Required',
            'itemsA.*.mon6.min' => 'Invalid quantity',
            'itemsA.*.mon6.integer' => 'Invalid format',
            'itemsA.*.mon6.required' => 'Required',
            'itemsA.*.mon7.min' => 'Invalid quantity',
            'itemsA.*.mon7.integer' => 'Invalid format',
            'itemsA.*.mon7.required' => 'Required',
            'itemsA.*.mon8.min' => 'Invalid quantity',
            'itemsA.*.mon8.integer' => 'Invalid format',
            'itemsA.*.mon8.required' => 'Required',
            'itemsA.*.mon9.min' => 'Invalid quantity',
            'itemsA.*.mon9.integer' => 'Invalid format',
            'itemsA.*.mon9.required' => 'Required',
            'itemsA.*.mon10.min' => 'Invalid quantity',
            'itemsA.*.mon10.integer' => 'Invalid format',
            'itemsA.*.mon10.required' => 'Required',
            'itemsA.*.mon11.min' => 'Invalid quantity',
            'itemsA.*.mon11.integer' => 'Invalid format',
            'itemsA.*.mon11.required' => 'Required',
            'itemsA.*.mon12.min' => 'Invalid quantity',
            'itemsA.*.mon12.integer' => 'Invalid format',
            'itemsA.*.mon12.required' => 'Required',
            'itemsA.*.price.min' => 'Invalid amount',
            'itemsA.*.price.numeric' => 'Required',
            'itemsA.*.price.regex' => 'Invalid format',
            'itemsA.*.total_quantity.min' => 'Invalid quantity',
            'itemsA.*.total_quantity.integer' => 'Invalid format',
            'itemsB.*.unit_of_measure_id.required' => 'Required',
            'itemsB.*.item_id.required' => 'Please select an item.',
            'itemsB.*.mon1.min' => 'Invalid quantity',
            'itemsB.*.mon1.integer' => 'Invalid format',
            'itemsB.*.mon1.required' => 'Required',
            'itemsB.*.mon2.min' => 'Invalid quantity',
            'itemsB.*.mon2.integer' => 'Invalid format',
            'itemsB.*.mon2.required' => 'Required',
            'itemsB.*.mon3.min' => 'Invalid quantity',
            'itemsB.*.mon3.integer' => 'Invalid format',
            'itemsB.*.mon3.required' => 'Required',
            'itemsB.*.mon4.min' => 'Invalid quantity',
            'itemsB.*.mon4.integer' => 'Invalid format',
            'itemsB.*.mon4.required' => 'Required',
            'itemsB.*.mon5.min' => 'Invalid quantity',
            'itemsB.*.mon5.integer' => 'Invalid format',
            'itemsB.*.mon5.required' => 'Required',
            'itemsB.*.mon6.min' => 'Invalid quantity',
            'itemsB.*.mon6.integer' => 'Invalid format',
            'itemsB.*.mon6.required' => 'Required',
            'itemsB.*.mon7.min' => 'Invalid quantity',
            'itemsB.*.mon7.integer' => 'Invalid format',
            'itemsB.*.mon7.required' => 'Required',
            'itemsB.*.mon8.min' => 'Invalid quantity',
            'itemsB.*.mon8.integer' => 'Invalid format',
            'itemsB.*.mon8.required' => 'Required',
            'itemsB.*.mon9.min' => 'Invalid quantity',
            'itemsB.*.mon9.integer' => 'Invalid format',
            'itemsB.*.mon9.required' => 'Required',
            'itemsB.*.mon10.min' => 'Invalid quantity',
            'itemsB.*.mon10.integer' => 'Invalid format',
            'itemsB.*.mon10.required' => 'Required',
            'itemsB.*.mon11.min' => 'Invalid quantity',
            'itemsB.*.mon11.integer' => 'Invalid format',
            'itemsB.*.mon11.required' => 'Required',
            'itemsB.*.mon12.min' => 'Invalid quantity',
            'itemsB.*.mon12.integer' => 'Invalid format',
            'itemsB.*.mon12.required' => 'Required',
            'itemsB.*.description.required' => 'Required',
            'itemsB.*.price.min' => 'Invalid amount',
            'itemsB.*.price.numeric' => 'Required',
            'itemsB.*.price.regex' => 'Invalid format',
            'itemsB.*.total_quantity.min' => 'Invalid quantity',
            'itemsB.*.total_quantity.integer' => 'Invalid format',
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
            if(request('itemsA') == array() && request('itemsB') == array()){
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
