<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Usuario;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;

class UsuarioController extends Controller
{
	  function mostrarLogin()
	  {
	      return view('auth.login');
	  }

	  function iniciarSesion(Request $request)
	  {

	   	  $validator = $this->validate($request,["usuario"=>"required","clave"=>"required"],
	      ["usuario.required"=>"Ingrese su usuario",
	      "clave.required"=>"Ingrese su contraseña"]);
	        
	      $usuario=$request->get("usuario");
		  $clave=$request->get("clave");
	      $user = Usuario::where('usuario','=',$usuario)->where('clave','=',$clave)->first();

	  		if(!$user)
	  		{
	  		    return back()->with("mensaje","Usuario y/o contraseña incorrectos")
	  		    ->withInput();
	  		}
		    session(["usuario"=>$usuario]);
	      	return redirect()->route("panel");
	      
	  }

	  function cerrarSesion()
	  {
	    Session::forget("usuario");
	    Session::flush();
	    return redirect()->route("login");  
	  }
}
