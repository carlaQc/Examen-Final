<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'=> 'image|mimes:jpeg,png|max:6000',
            'name' => 'required|min: 1|max: 15',
            'price' => 'required|Integer|min: 15|max:35',
            'description' => 'required'
        ];
    }
}
