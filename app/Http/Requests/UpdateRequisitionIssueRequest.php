<?php

namespace App\Http\Requests;

use App\Repositories\LibraryRepository;
use App\Repositories\RequisitionIssueRepository;
use App\Rules\LibraryExistRule;
use App\Rules\MaxQuantity;
use App\Transformers\FormProcessTransformer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequisitionIssueRequest extends FormRequest
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
            'requested_by_name' => ['required', 'string'],
            'approved_by_name' => ['required', 'string'],
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
            $requisition_issue = (new RequisitionIssueRepository())->attach('form_process')->getById(request('id'));
            if($requisition_issue->requested_by_id != request('requested_by_id')){
                $this->validateRequestedBy($validator, $requisition_issue);
            }
            $this->validateUpdatability($validator, $requisition_issue);
        });
    }

    public function validateRequestedBy($validator, $requisition_issue)
    {
        $process = fractal($requisition_issue->form_process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $key = array_search("ris_aprroval_from_division", array_column($form_routes, 'description_code'));
        if($key){
            if($form_routes[$key]['status'] == "approved"){
                $validator->errors()->add("requested_by_name", "The ris is already approved by ".$form_routes[$key]['office_name']);
            }
        }else{
            $key = array_search("route_origin", array_column($form_routes, 'description_code'));
            if($form_routes[$key]['status'] == "approved"){
                $validator->errors()->add("requested_by_name", "The ris is already approved by ".$form_routes[$key]['office_name']);
            }
        }
    }

    public function validateUpdatability($validator, $requisition_issue)
    {
        $process = fractal($requisition_issue->form_process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $key = array_search("last_route", array_column($form_routes, 'description_code'));
        if($form_routes[$key]['status'] != "pending"){
            $validator->errors()->add("update_error", "Update unavailable");
        }
    }
}
