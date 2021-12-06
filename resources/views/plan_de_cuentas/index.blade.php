<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan de cuentas') }}
        </h2>
    </x-slot>

    <div class="flex justify-center ">
        <div class=" justify_center  ">
            <x-cardsinicio ruta="tipo_cuentas">
                <x-slot name="numero">1</x-slot>
                <x-slot name="titulo">Tipos de cuenta</x-slot>
                <x-slot name="descripcion">En esta seccion podra agregar, editar y eliminar tipos de cuenta</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            <x-cardsinicio ruta="subtipo_cuentas">
                <x-slot name="numero">2</x-slot>
                <x-slot name="titulo">Subtipos de cuenta</x-slot>
                <x-slot name="descripcion">En esta seccion podra agregar, editar y eliminar subtipos de cuenta</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
        </div>
        <div class="justify_center">
            <p class="flex justify-center p-6 text-gray-700 font-bold text-2xl">Plan de cuentas del colegio ABC</p>
            <div class="flex justify-end ml-20 mr-20 ">
                @if (Auth::user()->current_team_id != 3)
                <a type="button"class=" pr-5 pl-5 mt-1  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('plan_de_cuentas/insertar')}}">Agregar una cuenta nueva</a>
                @endif
                
            </div>
            <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                <thead>
                    <tr class=" text-left border-b-2 border-gray-300  " >
                        <th class="px-4 py-3">Código</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Descripcion</th>
                        @if (Auth::user()->current_team_id != 3)
                        <th class="px-4 py-3">Opciones</th>
                        @endif
                       
                    </tr>
                </thead>
                <tbody >
                    
                    @foreach ($plan_de_cuentas as $item)
                    <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                        <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id}}</td>
                        <td class="px-4 py-3">{{$item->nombre}}</td>
                        <td class="px-4 py-3">{{$item->descripcion}}</td>
                        @if (Auth::user()->current_team_id != 3)
                        <td class="px-4 py-3">
                            <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('plan_de_cuentas/editar',$item->id)}}">editar</a><br>
                            <form action="{{route('plan_de_cuentas/del',$item)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" >Borrar</button>
                                
                            </form>
                            
                        </td>
                        @endif
                        
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div>
                {{$plan_de_cuentas->links()}}
            </div>
          
        </div>
    </div>
    

</x-app-layout>