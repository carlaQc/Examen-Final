<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdate extends FormRequest
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
            // 'photo'=> 'image|mimes:jpeg,png|max:6000',
            // 'name'=> 'min: 3|max: 15',
            // 'paternal' => 'min: 3|max: 20',
            // 'maternal' => 'min: 3|max: 20',
            // 'address' => 'min: 5|max: 40',
            // // Verificar si valida mediante el auth
            // 'email' => 'email|unique:users,email,'. auth()->user()->id .',id',
            // 'ci' => 'numeric|digits_between:7,13',
            // 'phone' => 'numeric|digits_between:8,15',
            // 'password' => 'max: 20'
        ];
    }
}
