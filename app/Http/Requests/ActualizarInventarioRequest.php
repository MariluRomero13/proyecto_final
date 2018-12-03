<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarInventarioRequest extends FormRequest
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

            "stock_n"=>"required|min:1|integer",
            "precio_v"=> "required|regex:/^\d+(\.\d{1,2})?$/",
            "precio_c"=>"required|regex:/^\d+(\.\d{1,2})?$/",
            
        ];
    }


    public function messages()
    {
      return [
        'stock_n.integer' => 'Solamente se permiten números',
        'stock_n.required' => 'Olvidaste ingresar el stock del producto',
        'stock_n.min' => 'El stock minímo debe ser de 1',
        'precio_v.required' => 'Olvidaste ingresar precio de venta',
        'precio_v.regex' => 'Solamente se permiten números',
        'precio_c.required' => 'Olvidaste ingresar precio de venta',
        'precio_c.regex' => 'Solamente se permiten números'
        
      ];
    }
}
