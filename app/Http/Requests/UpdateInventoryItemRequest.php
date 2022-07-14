<?php

namespace App\Http\Requests;

use App\Rules\LibraryExistRule;
use App\Rules\MaxInt;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryItemRequest extends FormRequest
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
            'item_category_id' => ['required', new LibraryExistRule('item_category')],
            'unit_of_measure_id' => ['required', new LibraryExistRule('unit_of_measure')],
            'item_name' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
            'remaining_quantity' => ['required', 'integer', 'min:1', new MaxInt],
            'adjusted_quantity' => ['required', 'integer', new MaxInt],
        ];
    }
}
