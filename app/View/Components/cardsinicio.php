<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardsinicio extends Component
{
    public $numero;
    public $titulo;
    public $descripcion;
    public $boton;
    public $ruta;
    

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ruta="asiento_contable")
    {
        $this->ruta=$ruta;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cardsinicio');
    }
}
