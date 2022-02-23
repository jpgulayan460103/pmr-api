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
        if(request()->has('updater') && request('updater') == 'procurement'){
            $rules = [
                'procurement_type_id' => ['required', new LibraryExistRule('procurement_type')],
                'mode_of_procurement_id' => ['required', new LibraryExistRule('mode_of_procurement')],
                'procurement_type_category' => ['required', new LibraryExistRule('procurement_type_category')],
            ];
        }elseif(request()->has('updater') && request('updater') == 'budget'){
            $rules = [
                'purchase_request_number_last' => 'required|numeric|digits:5',
                'fund_cluster' => 'required',
                // 'center_code' => 'required',
                'charge_to' => 'required',
                'alloted_amount' => 'required',
                'uacs_code' => 'required',
                'sa_or' => 'required',
                // 'purchase_request_number' => 'required|unique:purchase_requests,purchase_request_number',
            ];
        }else{
            $rules = [
                'end_user_id' => ['required', new LibraryExistRule('user_section')], 
                'pr_date' => 'date|required',
                'purpose' => 'required',
                'items.*.item_name' => 'required',
                'items.*.unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
                'items.*.quantity' => 'numeric|min:1',
                'items.*.unit_cost' => ['numeric','min:0','regex:/^\d{1,15}(\.\d{1,2})?$/'],
            ];
        }
        return $rules;
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
            'procurement_type_id.required' => 'Please select procurement type.',
            'procurement_type_category.required' => 'Please select procurement category.',
            'mode_of_procurement_id.required' => 'Please select mode of procurement.',
            'purchase_request_number.unique' => 'The purchase request number is already in the database.',
            // 'purchase_request_number_last.required' => 'The office/section is required.',
            // 'fund_cluster.required' => 'The office/section is required.',
            // 'center_code.required' => 'The office/section is required.',
            // 'charge_to.required' => 'The office/section is required.',
            // 'alloted_amount.required' => 'The office/section is required.',
            // 'uacs_code.required' => 'The office/section is required.',
            // 'sa_or.required' => 'The office/section is required.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(request()->has('updater') && request('updater') == 'budget'){
                if(request()->has('id') && request()->has('purchase_request_number')){
                    $purchase_request = PurchaseRequest::where('purchase_request_number', request('purchase_request_number'))->where('id','<>',request('id'))->count();
                    if($purchase_request != 0){
                        $validator->errors()->add("purchase_request_number_last", "The purchase number field is already in the database.");
                    }
                }
            }

            if(request()->has('requested_by_id')){
                $this->validateRequestedBy($validator);
            }
        });
    }

    public function validateRequestedBy($validator)
    {
        $purchaseRequestRepository = new PurchaseRequestRepository;
        $purchase_request = $purchaseRequestRepository->attach('form_process')->getById(request('id'));
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
}
