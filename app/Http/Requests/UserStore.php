<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'name_center' => 'required|min: 3|max: 15',
            'nit' => 'required|numeric|digits_between:8,15',
            'address_center' => 'required|min: 5|max: 200',
            'cellphone' => 'required|numeric|digits_between:7,15|unique:info_centers,cellphone',
            'name'=> 'required|min: 3|max: 15',
            'paternal' => 'required|min: 3|max: 20',
            'maternal' => 'required|min: 3|max: 20',
            'gender' => 'required|numeric|digits_between:1,2',
            'address' => 'required|min: 5|max: 40',
            'email' => 'required|email|unique:users',
            'ci' => 'required|numeric|digits_between:7,13|unique:users,ci',
            'phone' => 'required|numeric|digits_between:8,15'
        ];
    }
}
