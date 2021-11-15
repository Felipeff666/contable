<?php

namespace App\Http\Controllers\inicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class inicioController extends Controller
{
    function __invoke()
    {
        return view('inicio/inicio');
    }
}
