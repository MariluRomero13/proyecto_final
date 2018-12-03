<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertarInventarioRequest extends FormRequest
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
            "idproducto"=>"required",
            "stock_a"=>"required|min:1|integer",
            "precio_v"=> "required|regex:/^\d+(\.\d{1,2})?$/",
            "precio_c"=>"required|regex:/^\d+(\.\d{1,2})?$/",
            
        ];
    }


    public function messages()
    {
      return [
        'idproducto.required' => 'Olvidaste seleccionar un producto',
        'stock_a.integer' => 'Solamente se permiten números',
        'stock_a.required' => 'Olvidaste ingresar el stock inicial del producto',
        'stock_a.min' => 'El stock minímo debe ser de 1',
        'precio_v.required' => 'Olvidaste ingresar precio de venta',
        'precio_v.regex' => 'Solamente se permiten números',
        'precio_c.required' => 'Olvidaste ingresar precio de venta',
        'precio_c.regex' => 'Solamente se permiten números'
        
      ];
    }
}
