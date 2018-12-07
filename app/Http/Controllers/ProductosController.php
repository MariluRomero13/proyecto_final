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
use Carbon\Carbon;
use App\Http\Requests\InsertarProductoRequest;
use App\Http\Requests\ActualizarProductoRequest;

class ProductosController extends Controller
{
    
    function __construct()
    {
         $this->middleware('verificador');
    }
    function viewregistrarproductos() //mostrar formulario de registro
    {
        $cat = Categoria::all();
    	return view("productos.ingresarproductos",compact('cat'));
    }

    function verproductos() //mostrar formulario donde se ven los registros de los productos
    {
        $productos = Producto::has('categorias')->paginate(3);
        return view("productos.verproductos", compact('productos'));
    }

    function seleccionarproducto($id)
    {

      $cat = Categoria::all();
      $consulta = DB::table('categorias')
      ->join('productos', 'categorias.id',   '=','productos.categoria_id')
      ->select('categorias.id as cateid', 'categorias.nombre as catenombre','productos.id as prodid',"productos.codigo",'productos.nombre', 'productos.descripcion', 'productos.imagen')
      ->where('productos.id','=', $id)
      ->get();

        return view('productos.actualizarproductos', compact('consulta','cat'));
    }


    function registrarproducto(InsertarProductoRequest $request)
    {
        
    	$info = $request->imagen;
        $photo = $request->file('imagen')->getClientOriginalName();
        $destination = base_path().'/public/imagenes/imagenes_productos';
        $request->file('imagen')->move($destination, $photo);
        

        $id = $request->categoria;
        $categoria = Categoria::find($id);
        $Prod = new Producto();
        $Prod->codigo = $request->get("codigo");
        $Prod->nombre = $request->nombre;
        $Prod->imagen = $photo;

        if($request->descripcion == "")
        {
            $Prod->descripcion = "Sin descripcion del articulo";
        }
        else
        {
            $Prod->descripcion = $request->descripcion;
        }
        $categoria->productos()->save($Prod);
        return redirect()->route("viewproductos");
    
        //Sin descripcion del articulo
    }


    function actualizarproducto(ActualizarProductoRequest $request, $id)
    {
        $idc = $request->categoria;
        $categoria = Categoria::find($idc);
        $prodmod = Producto::findOrFail($id);
      
        
        $prodmod->nombre = $request->nombre;
        $prodmod->descripcion = $request->descripcion;
        if ($request->imagen) 
        {
            $info = $request->imagen;
            $photo = $request->file('imagen')->getClientOriginalName();
            $destination = base_path().'/public/imagenes/imagenes_productos';
            $request->file('imagen')->move($destination, $photo);
            $prodmod->imagen = $photo;
        }

        $categoria->productos()->save($prodmod);
        return redirect()->route("viewproductos");

       
    }

    function eliminarproducto(Request $request, $id)
    {  
        $Prod = Producto::destroy($id);
        return redirect()->route("viewproductos");
    }

    function vermas($id)
    {
        $consulta = DB::table('categorias')
          ->join('productos', 'categorias.id',   '=','productos.categoria_id')
          ->select('categorias.id as cateid', 'categorias.nombre as catenombre','productos.id as prodid','productos.nombre', 'productos.descripcion', 'productos.imagen', "productos.codigo")
          ->where('productos.id','=', $id)
          ->get();
          return view("productos.vermas",compact("consulta"));
    }

    function buscar(Request $r)
    {
        $busqueda = DB::table('categorias')
            ->join('productos', 'categorias.id', '=','productos.categoria_id')
            ->select('productos.codigo','productos.id','productos.nombre', 'productos.descripcion', 'productos.imagen')->where("productos.nombre",'LIKE',"%".$r->get("valor")."%")
            ->orWhere("productos.codigo",'LIKE',"%".$r->get("valor")."%")->get();

        if ($r->get("valor") == "") 
        {
             $todo= DB::table('categorias')
            ->join('productos', 'categorias.id', '=','productos.categoria_id')
            ->select('productos.codigo','productos.id','productos.nombre', 'productos.descripcion', 'productos.imagen')->get();
             return ["status" => 2, "todo" => $todo];
        }

        if ($busqueda->count() > 0) 
        {
             return ["status"=> 1, "productos" => $busqueda];
        } 
        return ["status"=> 0, "error" => "Productos no encontrado"];
    }

    function buscar_producto_inventario(Request $r)
    {
        $productos = DB::table("productos")
            ->join("inventario","producto_id", "=","productos.id")
            ->select("inventario.id as invid","productos.codigo as codi","productos.id as codigo","productos.nombre","inventario.stock_actual as stock",
                "inventario.precio_venta as precio")
            ->where("productos.codigo","=",$r->get("valor"))
            ->where("inventario.stock_actual",">","0")->get();
        
        return ["status"=> 1, "productos"=> $productos];
           
    }
}
