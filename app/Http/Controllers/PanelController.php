<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PanelController extends Controller
{
	function __construct()
    {
         $this->middleware('verificador');
    }
    public function index()
    {
   		return view("panel.inicio");
    }
}
