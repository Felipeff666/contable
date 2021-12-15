<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\plan_cuentas\plan_de_cuentas;
use App\Models\resultados\res_libro_diario;
use Illuminate\Http\Request;

class res_libro_diarioController extends Controller
{
    function index(){
        $plan_de_cuentas = plan_de_cuentas::all();
        $res_l_diario = res_libro_diario::all();
        return view('resultados/libro_diario/index',compact('res_l_diario','plan_de_cuentas'));
    }
}
