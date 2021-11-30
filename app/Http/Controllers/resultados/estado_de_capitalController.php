<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\resultados\estado_de_capital;
use Illuminate\Http\Request;

class estado_de_capitalController extends Controller
{
    function index(){

        $estado_de_capital=estado_de_capital::all();
        return view('resultados/estado_de_capital/index',compact('estado_de_capital'));

    }
}
