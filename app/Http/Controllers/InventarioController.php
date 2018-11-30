<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Producto;
use App\Modelos\Categoria;
use App\Modelos\Inventario;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon; 

class InventarioController extends Controller
{
    function viewRegistrarInventario()
    {
    	$productos = Producto::doesnthave("inventario")->get();
    	return view("inventario.crearInventario", compact("productos"));
    }

    function registrarInventario(Request $r)
    {
    	$this->validate($r,
        	["idproducto"=>"required", "stock_a"=>"required", "precio_v"=>"required", "precio_c" => "required", "fecha_a"=>"required"],
        	["idproducto.required"=>"Seleccione el producto", "stock_a.required"=>"Ingrese el stock actual", "precio_v.required"=>"Ingrese el precio de venta", "precio_c.required"=>"Ingrese el precio de compra", "fecha_a.required"=>"Ingrese la fecha de adquisicion"]);

    	
		$producto = Producto::find($r->idproducto);
    	$inventario = new Inventario();
    	$inventario->stock_actual = $r->stock_a;
    	$inventario->precio_venta = $r->precio_v;
    	$inventario->precio_compra = $r->precio_c; 
    	$inventario->fecha_adquisicion = $r->fecha_a;
    	$producto->inventario()->save($inventario);

        return redirect()->route('viewInventario');
    	
    }

    function viewInventario()
    {
        $inventario = Inventario::all();
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

        $inventario = DB::table('productos')->join("inventario" ,"productos.id", "=", "inventario.producto_id")->select("inventario.id as inventarioid", "productos.nombre", "inventario.stock_actual", "inventario.precio_compra", "inventario.precio_venta", "inventario.fecha_adquisicion")->where("inventario.id", "=", $id)->get();

        //return $inventario;

        return view("inventario.actualizarInventario", compact("inventario"));
    }

    function actualizarInventario(Request $r, $id)
    {
        $inventario = inventario::find($id);
        $inventario->stock_actual = $inventario->stock_actual  +  $r->stock_n;
        $inventario->precio_venta = $r->precio_v;
        $inventario->precio_compra = $r->precio_c;
        $inventario->fecha_adquisicion = $r->fecha_a;
        $inventario->save();

        return redirect()->route("viewInventario");
    }

    function eliminarInventario(Request $r, $id)
    {
        $inventario = inventario::destroy($id);
        return redirect()->route("viewInventario");
    }

}
