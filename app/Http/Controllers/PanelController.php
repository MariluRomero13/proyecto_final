<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PanelController extends Controller
{
    public function index()
    {
   		return view("panel.inicio");
    }
}
