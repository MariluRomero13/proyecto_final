<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarProductoRequest extends FormRequest
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

    public function rules()
    {
        return [
            "nombre"=>"required|max:48|min:3",
            "categoria"=>"required",
            "descripcion"=>"nullable"
        ];
    }

    // Devuelve un mensaje por cada atributo erróneo
    public function messages()
    {
      return [
        'nombre.required' => 'Olvidaste ingresar el nombre del producto',
        'nombre.max' => 'El nombre del producto no puede ser mayor a 48 dígitos',
        'nombre.min' => 'El nombre del producto no puede ser menor a 3 dígitos',
      ];
    }
}
