<?php

namespace App\Http\Requests\Example;

use Illuminate\Foundation\Http\FormRequest;

class ExampleStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'blocks' => 'nullable|array',
            'blocks.*.name' => 'required|string|max:255',
            'blocks.*.description' => 'required|string',
        ];
    }
}
