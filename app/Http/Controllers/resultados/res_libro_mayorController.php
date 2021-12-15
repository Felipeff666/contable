<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\resultados\res_libro_mayor;
use Illuminate\Http\Request;

class res_libro_mayorController extends Controller
{
    function index(){
        $res_l_mayor = res_libro_mayor::all();
        return view('resultados/libro_mayor/index',compact('res_l_mayor'));
    }
}
