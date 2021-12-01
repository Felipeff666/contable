<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Models\usuarios\roles;
use App\Models\usuarios\usuarios;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/* usados para validar el password del formulario de registros*/
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
/*fin*/

class usuariosController extends Controller
{       
    

    function index(){

        $roles= roles::all();
        $usuarios= usuarios::all();
        
        return view('usuarios/index',compact('usuarios','roles'));
    }
    function insertar_usuario(){
        $roles= roles::all();
        return view('usuarios/insertar',compact('roles'));
    }

    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'confirmed'];
    }

    function store( Request $request ){


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            /* 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '', */
        ]);

        $usuarios = new usuarios();
        $usuarios->name= $request->name;  
        $usuarios->email= $request->email;  
        $usuarios->password= Hash::make($request->password);
        $usuarios->current_team_id= $request->rol;  
        $usuarios->save();
        return redirect(route('usuarios'));
    }
    
    function editar_usuario(usuarios $usuarios){

        $roles= roles::all();
        return view('usuarios/editar',compact('usuarios','roles'));

    }
    function update(Request $request,usuarios $usuarios){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($usuarios->id)],
            'password' => $this->passwordRules(),
            /* 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '', */
        ]);

        $usuarios->name= $request->name;  
        $usuarios->email= $request->email;  
        $usuarios->password= Hash::make($request->password);
        $usuarios->current_team_id= $request->rol;  
        $usuarios->save();
        return redirect(route('usuarios'));

    }
    function destroy(usuarios $usuarios){
        
        $usuarios->delete();
        return redirect(route('usuarios'));
    }
}
