<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CenterUpdate extends FormRequest
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
            // 'photo' => 'required|image|mimes:jpeg,png|max:6000'
            // 'name_center' => 'required|min: 3|max: 15',
            // 'cellphone' => 'required|numeric|digits_between:7,13|unique:info_centers'
        ];
    }
}
