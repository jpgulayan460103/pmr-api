<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LibraryExistRule;

class UpdateFormProcessRequest extends FormRequest
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
        if(request()->has('type') && request('type')){
            $rules = [
                'technical_working_group_id' => ['required', new LibraryExistRule('technical_working_group')],
            ];
        }else{
            $rules = [];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'technical_working_group_id.required' => 'Please select technical working group.'
        ];
    }
}
