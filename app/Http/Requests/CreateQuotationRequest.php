<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxQuantity;

class CreateQuotationRequest extends FormRequest
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
            'purchase_request_id' => 'required',
            'supplier_id' => 'required',
            'supplier_contact_id' => 'required',
            'prepared_by_id' => 'required',
            'items.*.item_name' => 'required',
            'items.*.unit_of_measure_id' => 'required',
            'items.*.quantity' => 'numeric|min:1',
            'items.*.unit_cost' => ['numeric','min:0','regex:/^\d{1,15}(\.\d{1,2})?$/'],
        ];
    }
}
