<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\inicio\libro_diario;
use App\Models\plan_cuentas\plan_de_cuentas;
use App\Models\resultados\res_libro_diario;
use PDF;
use Illuminate\Http\Request;

class res_libro_diarioController extends Controller
{
    function index(){
        $plan_de_cuentas = plan_de_cuentas::all();
        $res_l_diario = res_libro_diario::all();
        return view('resultados/libro_diario/index',compact('res_l_diario','plan_de_cuentas'));
    }

    function pdf(){
        $libros_diarios = libro_diario::all();
        $plan_de_cuentas = plan_de_cuentas::all();
        $res_l_diario = res_libro_diario::all();
        $pdf = PDF::loadView('resultados/pdf/l_diario',['plan_de_cuentas'=>$plan_de_cuentas,'res_l_diario'=>$res_l_diario,'libros_diarios'=>$libros_diarios]);
        return $pdf->stream('libro_diario_'.date('d').'-'.date('m').'-'.date('y').'.pdf');
    }
}
