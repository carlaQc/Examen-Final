<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGestionUpdate extends FormRequest
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
            'name'=> 'required|min: 3|max: 15',
            'paternal' => 'required|min: 3|max: 20',
            'maternal' => 'required|min: 3|max: 20',
            'address' => 'required|min: 5|max: 100',
            'email' => 'required|email|unique:users,email,'. $this->route('id') .',id',
            'ci' => 'required|numeric|digits_between:7,13',
            'phone' => 'required|numeric|digits_between:8,15',
        ];
    }
}
