<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Producto;
use App\Modelos\Categoria;
use App\Modelos\Inventario;
use App\Modelos\DetalleInventario;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 
use Validator;
use App\Http\Requests\InsertarInventarioRequest;
use App\Http\Requests\ActualizarInventarioRequest;

class InventarioController extends Controller
{
    function viewRegistrarInventario()
    {
    	$productos = Producto::doesnthave("inventario")->get();
    	return view("inventario.crearInventario", compact("productos"));
    }

    function registrarInventario(InsertarInventarioRequest $r)
    {
    	
		$producto = Producto::find($r->idproducto);
        $inventario = new Inventario();
        $inventario->stock_actual = $r->stock_a;
        $inventario->precio_venta = $r->precio_v;
        $inventario->precio_compra = $r->precio_c; 
        $producto->inventario()->save($inventario);
        return redirect()->route('viewInventario');
    }

    function viewInventario()
    {
        $inventario = DB::table('productos')->join("inventario" ,"productos.id", "=", "inventario.producto_id")->select("inventario.id as invid", "productos.id as codigo", "productos.nombre", "inventario.stock_actual", "inventario.precio_compra", "inventario.precio_venta")->paginate(4);
        return view("inventario.mostrarInventario", compact("inventario"));
    }

    function viewActualizarInventario($id)
    {
        /*$productos = Producto::with('inventario')->join("inventario", "productos.id", "=", "inventario.producto_id")->select("productos.nombre", "inventario.stock_actual")->where("productos.id", "=", $id)->get();*/
        //return $productos;

        /*$productos = Producto::wherehas("inventario", function($q) use($id){
            $q->where("id", "=", $id);
        })->get();*/

        //$productos->load("inventario");
        //$Cliente->load("bicicletas"); 
        //return view("viewClientesSinBicicleta", compact("Cliente"));

        $inventario = DB::table('productos')->join("inventario" ,"productos.id", "=", "inventario.producto_id")->select("inventario.id as inventarioid", "productos.nombre", "inventario.stock_actual", "inventario.precio_compra", "inventario.precio_venta")->where("inventario.id", "=", $id)->get();

    
        return view("inventario.actualizarInventario", compact("inventario"));
    }

    function actualizarInventario(ActualizarInventarioRequest $r, $id)
    {   

        
        $inventario = inventario::find($id);
        $inventario->stock_actual = $inventario->stock_actual  +  $r->stock_n;
        $inventario->precio_venta = $r->precio_v;
        $inventario->precio_compra = $r->precio_c;
        $inventario->save();


        $d_inventario = new DetalleInventario();;
        $now = new Carbon('America/Mexico_City');
        $d_inventario->fecha_adquisicion = $now->now();
        $d_inventario->cantidad_solicitada = $r->stock_n;
        $inventario->detalle_inventario()->save($d_inventario);

        return redirect()->route("viewInventario");
    }

    function eliminarInventario(Request $r, $id)
    {
        $inventario = inventario::destroy($id);
        return redirect()->route("viewInventario");
    }

    function buscar(Request $r)
    {
        $busqueda = DB::table('productos')->join("inventario" ,"productos.id", "=", "inventario.producto_id")->select("inventario.id as invid", "productos.id as codigo", "productos.nombre", "inventario.stock_actual", "inventario.precio_compra", "inventario.precio_venta")->where("productos.nombre",'LIKE',"%".$r->get("valor")."%")->get();

        if ($r->get("valor") == "") 
        {
             $todo = DB::table('productos')->join("inventario" ,"productos.id", "=", "inventario.producto_id")->select("inventario.id as invid", "productos.id as codigo", "productos.nombre", "inventario.stock_actual", "inventario.precio_compra", "inventario.precio_venta")->get();
             return ["status" => 2, "todo" => $todo];
        }

        if ($busqueda->count() > 0) 
        {
             return ["status"=> 1, "inventario" => $busqueda];
        } 
        return ["status"=> 0, "error" => "Registro no encontrado"];

    }

}
