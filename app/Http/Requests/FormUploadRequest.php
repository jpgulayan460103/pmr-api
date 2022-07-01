<?php

namespace App\Http\Requests;

use App\Rules\AllowedFileName;
use Illuminate\Foundation\Http\FormRequest;

class FormUploadRequest extends FormRequest
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
            'meta.description' => ['required', new AllowedFileName("The description contains invalid characters.")],
            'file' => 'file|max:256000|mimetypes:application/pdf,image/jpeg,image/png'
        ];
    }

    public function messages()
    {
        return [
            'meta.description.required' => 'File description is required.',
            'file.max' => 'File size must not be greater than 256 MB.',
        ];
    }
}
