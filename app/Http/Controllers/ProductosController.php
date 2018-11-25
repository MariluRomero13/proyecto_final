<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Producto;
use App\Modelos\Categoria;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use View;
use function view;
use function redirect;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;

class ProductosController extends Controller
{
 
    function viewregistrarproductos()
    {
        $cat = Categoria::all();
    	return view("productos.ingresarproductos",compact('cat'));
    }

    function verproductos()
    {
        $product = Producto::all();
        $cat = Categoria::all();
        return view("productos.verproductos", compact('product','cat'));
    }


    //Selectores
    function altaProducto()
    {
        $Prod = Producto::find(1);
        return view('ingresarproductos', compact('Prod'));
    }

    function seleccionarproducto($id)
    {
        $prod = Producto::find($id);
        $cat = Categoria::all();

        return view('productos.actualizarproductos', compact('prod','cat'));
    }


    function registrarproducto(Request $request)
    {
        $this->validate($request,
        	["id"=>"required", "nombre"=>"required", "descripcion"=>"required", "imagen" => "required", "categoria"=>"required"],
        	["id.required"=>"Ingrese el Codigo", "nombre.required"=>"Ingrese el nombre", "descripcion.required"=>"Ingrese la descripcion", "categoria.required"=>"Ingrese la categoria", "imagen.required"=>"Ingrese la imagen"]);

        //Imagen
    	$info = $request->imagen;
        $photo = $request->file('imagen')->getClientOriginalName();
        $destination = base_path().'/public/imagenes/imagenes_productos';
        $request->file('imagen')->move($destination, $photo);
        //

        $Prod = new Producto();
        $Prod->id = $request->id;
        $Prod->id_categoria = $request->categoria;
        $Prod->nombre = $request->nombre;
        $Prod->descripcion = $request->descripcion;
        $Prod->imagen = $photo;

    	$Prod->save();

        return Redirect::to("/viewproductos");
    }


    function actualizarproducto(Request $request, $id)
    {

        $prodmod = Producto::findOrFail($id);
      
        $prodmod->nombre = $request->nombre;
        $prodmod->id_categoria = $request->categoria;
        $prodmod->descripcion = $request->descripcion;

        if ($request->imagen) 
        {
            //
            $info = $request->imagen;
            $photo = $request->file('imagen')->getClientOriginalName();
            $destination = base_path().'/public/imagenes/imagenes_productos';
            $request->file('imagen')->move($destination, $photo);
            $prodmod->imagen = $photo;
            //
        }
        $prodmod->save();
       
        return Redirect::to("/viewproductos");   
    }

    function eliminarproducto(Request $request, $id)
    {  
        $Prod = Producto::destroy($id);
        return Redirect::to("/viewproductos");
    }
}
