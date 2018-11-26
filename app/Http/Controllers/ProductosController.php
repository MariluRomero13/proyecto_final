<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Producto;
use App\Modelos\Categoria;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;


class ProductosController extends Controller
{
 
    function viewregistrarproductos() //mostrar formulario de registro
    {
        $cat = Categoria::all();
    	return view("productos.ingresarproductos",compact('cat'));
    }

    function verproductos() //mostrar formulario donde se ven los registros de los productos
    {
        //$product = Producto::all();
        //$cat = Categoria::all();
        $productos = Producto::has('categorias')->get();
        return view("productos.verproductos", compact('productos'));
    }


    //Selectores
    function altaProducto()
    {
        //$Prod = Producto::find(1);
        //return view('ingresarproductos', compact('Prod'));
    }

    function seleccionarproducto($id)
    {

      $cat = Categoria::all();
      $consulta = DB::table('categorias')
      ->join('productos', 'categorias.id',   '=','productos.categoria_id')
      ->select('categorias.id as cateid', 'categorias.nombre as catenombre','productos.id','productos.nombre', 'productos.descripcion', 'productos.imagen')
      ->where('productos.id','=', $id)
      ->get();
        
        //return $consulta;
        return view('productos.actualizarproductos', compact('consulta','cat'));

        //$prod = Producto::find($id);
        //
    }


    function registrarproducto(Request $request)
    {
        $this->validate($request,
        	["id"=>"required", "nombre"=>"required", "descripcion"=>"required", "imagen" => "required", "categoria"=>"required"],
        	["id.required"=>"Ingrese un código", "nombre.required"=>"Ingrese un nombre", "descripcion.required"=>"Ingrese una descripción", "categoria.required"=>"Seleccione una categoría", "imagen.required"=>"seleccione una imágen"]);

        //Imagen
    	$info = $request->imagen;
        $photo = $request->file('imagen')->getClientOriginalName();
        $destination = base_path().'/public/imagenes/imagenes_productos';
        $request->file('imagen')->move($destination, $photo);
        

        $id = $request->categoria;
        $categoria = Categoria::find($id);


        $Prod = new Producto();
        $Prod->id = $request->id;
        $Prod->nombre = $request->nombre;
        $Prod->descripcion = $request->descripcion;
        $Prod->imagen = $photo;

        $categoria->productos()->save($Prod);
        return redirect()->route("viewproductos");
    
        
    }


    function actualizarproducto(Request $request, $id)
    {


        $id = $request->categoria;
        $categoria = Categoria::find($id);
        $prodmod = Producto::findOrFail($id);
      
        
        $prodmod->nombre = $request->nombre;
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

        $categoria->productos()->save($prodmod);
        return redirect()->route("viewproductos");

       
    }

    function eliminarproducto(Request $request, $id)
    {  
        $Prod = Producto::destroy($id);
        return redirect()->route("viewproductos");
    }
}
