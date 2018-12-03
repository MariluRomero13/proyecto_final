<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertarProductoRequest extends FormRequest
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
            "id"=>"integer|required|max:17|min:10",
            "nombre"=>"required|max:48|min:3",
            "imagen"=> "required",
            "categoria"=>"required",
            "descripcion"=>"nullable"
        ];
    }

    // Devuelve un mensaje por cada atributo erróneo
    public function messages()
    {
      return [
        'id.required' => 'Olvidaste ingresar el código del producto',
        'id.integer' => 'Solamente se permiten números',
        'id.max' => 'El código no puede ser mayor a 17 dígitos',
        'id.min' => 'El código no puede ser menor a 10 dígitos',
        'nombre.required' => 'Olvidaste ingresar el nombre del producto',
        'nombre.max' => 'El nombre del producto no puede ser mayor a 48 dígitos',
        'nombre.min' => 'El nombre del producto no puede ser menor a 3 dígitos',
        'imagen.required'=>'Seleccione una imágen',
        'categoria.required'=>'Seleccione una categoría'
      ];
    }
}

