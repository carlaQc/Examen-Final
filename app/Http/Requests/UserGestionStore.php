<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGestionStore extends FormRequest
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
            'gender' => 'required|numeric|digits_between:1,2',
            'address' => 'required|min: 15|max: 150',
            'email' => 'required|email|unique:users,email',
            'ci' => 'required|numeric|digits_between:7,13',
            'phone' => 'required|numeric|digits_between:8,15',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El campo Nombre es requerido.',
            'name.min'      => 'Debe tener al menos 3 caracteres.',
            'name.max'      => 'No debe sobre pasar los 15 caracteres.',
            'paternal.required' => 'El campo de Apellido Paterno es requerido.',
            'paternal.min'      => 'Debe tener al menos 3 caracteres.',
            'paternal.max'      => 'No debe sobre pasar los 20 caracteres.',
            'maternal.required' => 'El campo de Apellido Materno es requerido.',
            'maternal.min'      => 'Debe tener al menos 3 caracteres.',
            'maternal.max'      => 'No debe sobre pasar los 20 caracteres.',
            'gender.numeric'    => 'El campo genero es requerido.',
            'address.required'  => 'El campo Dirección es requerido.',
            'address.min'       => 'Debe tener al menos 15 caracteres.',
            'address.max'       => 'No debe sobre pasar los 150 caracteres.',
            'email.required'    => 'El campo Email es requerido.',
            'email.email'       => 'No es un correo valido.',
            'email.unique'      => 'El correo electrónico ya ha sido registrado.',
            'ci.required'       => 'El campo CI es requerido.',
            'ci.numeric'        => 'El campo debe ser numerico.',
            'ci.digits_between' => 'CI debe tener entre 7 y 13 dígitos.',
            'phone.required'    => 'El campo Ttelefono/Celular es requedido.',
            'phone.numeric'        => 'El campo debe ser numerico',
            'phone.digits_between' => 'El campo debe tener entre 8 a 15 digitos.'      
        ];
    }
}
