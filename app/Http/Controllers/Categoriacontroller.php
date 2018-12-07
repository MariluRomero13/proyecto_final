<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Categoria;
use App\Modelos\Producto;
use App\Http\Requests\InsertarCategoriaRequest;

class Categoriacontroller extends Controller
{
    function vista()
    {
        $categorias = Categoria::paginate(3);
    	return view("categorias.vcategoria", compact("categorias"));
    }

    function agregar()
    {
    	$productos = Producto::all();
    	return view("categorias.cateagregar", compact("productos"));
    }

    function agregarcate(InsertarCategoriaRequest $r)
    {
    	$cat = new Categoria();
    	$cat->nombre = $r->nombre;
    	$cat->descripcion = $r->descripcion;
    	$cat->save();
        if($cat->nombre)
         {        
            return back()->with("Mensaje", "La categoría de ".$cat->nombre." ha sido añadida");
         }
    }

    function veditarcate($id_cate)
    {
        $categorias = Categoria::find($id_cate);
        return view("categorias.editarcate", compact("categorias"));
    }

    function editarcate(request $r, $id)
    {
        $cat = Categoria::find($id);
        $cat->nombre = $r->nombre;
        $cat->descripcion = $r->descripcion;
        $cat->update();
        if($cat->nombre)
         {        
            return back()->with("Mensaje", "La categoría de ".$cat->nombre." ha sido actualizada");
         }
    }

    function eliminarcate($id)
    {  
        $cate = Categoria::destroy($id);
        return redirect()->route("viewcategorias");
    }

    function catalogo($id)
    {
        $categorias = Categoria::join("productos","categoria_id","=","categorias.id")
        ->select("productos.id","productos.nombre","productos.descripcion","productos.imagen")
        ->where("categorias.id","=",$id)
        ->paginate(3);
        //return $categorias;
        return view("categorias.catalogo", compact("categorias")); 
    }
}