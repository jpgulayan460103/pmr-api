<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LibraryExistRule;
use App\Models\PurchaseRequest;
use App\Repositories\LibraryRepository;
use App\Repositories\PurchaseRequestRepository;
use App\Transformers\FormProcessTransformer;

class UpdatePurchaseRequest extends FormRequest
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
            'title' => 'required',
            'items.*.item_name' => 'required',
            'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
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
            'account_id.required' => 'Please select procurement type.',
            'account_classification.required' => 'Please select Account Classification.',
            'mode_of_procurement_id.required' => 'Please select mode of procurement.',
            'purchase_request_number.unique' => 'The purchase request number is already in the database.',
            'uacs_code_id.required' => 'The office/section is required.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $purchaseRequestRepository = new PurchaseRequestRepository;
            $purchase_request = $purchaseRequestRepository->attach('form_process')->getById(request('id'));
            if(request()->has('requested_by_id')){
                $this->validateRequestedBy($validator, $purchase_request);
            }
            $this->validateUpdatability($validator, $purchase_request);
        });
    }

    public function validateRequestedBy($validator, $purchase_request)
    {
        $process = fractal($purchase_request->form_process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $key = array_search("OARD", array_column($form_routes, 'label'));
        $received_by_id_office_id = (new LibraryRepository)->getById(request('requested_by_id'))->parent->parent_id;
        if($received_by_id_office_id != $form_routes[$key]['office_id']){
            if($form_routes[$key]['status'] == "approved"){
                $validator->errors()->add("requested_by_id", "The purchase number already approved by ".$form_routes[$key]['office_name']);
            }
        }
    }

    public function validateUpdatability($validator, $purchase_request)
    {
        $process = fractal($purchase_request->form_process, new FormProcessTransformer)->toArray();
        $form_routes = $process['form_routes'];
        $key = array_search("BS", array_column($form_routes, 'label'));
        if($form_routes[$key]['status'] != "pending"){
            $validator->errors()->add("update_error", "Update unavailable");
        }
    }
}
