<?php
namespace App\Http\Controllers\plan_cuentas;

use App\Http\Controllers\Controller;
use App\Models\plan_cuentas\plan_de_cuentas;

use Illuminate\Http\Request;

class plandecuentasController extends Controller
{
    function index()
    {
        $plan_de_cuentas=plan_de_cuentas::all();
        return view('plan_de_cuentas/index',compact('plan_de_cuentas'));
    }
    function insertar_cuenta()
    {
        return view('plan_de_cuentas/insertar');
    }
    function editar_cuenta()
    {
        return view('plan_de_cuentas/editar');
    }
}
