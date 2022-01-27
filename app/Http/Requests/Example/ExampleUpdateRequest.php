<?php

namespace App\Http\Requests\Example;

use Illuminate\Foundation\Http\FormRequest;

class ExampleUpdateRequest extends ExampleStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ruels = parent::rules();
        $ruels['deleting_blocks'] = 'nullable|array';
        return $ruels;
    }
}
