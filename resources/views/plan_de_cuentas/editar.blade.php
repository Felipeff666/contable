<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar cuenta') }}
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('plan_de_cuentas')}}">volver</a>
    </x-slot>
   
    <div class="mr-10 ml-10 mt-4 bg-gray-200 h-full">
        <div class="w-full h-14 pt-2 text-center  bg-gray-700  shadow overflow-hidden sm:rounded-md font-bold text-3xl text-white ">
            Registro de tipos de cuenta
        </div>

        <section class="flex justify-center text-gray-900 body-font  m-0 p-0 relative ">
            Por favor ingrese todos lo datos necesarios
        </section>
        <div class="p-30">
            
            <form action="{{route('plan_de_cuentas/editar/edit',$cuenta)}}" method="POST" >
                @csrf
                @method('put')
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre </label>
                    @error('nombre')
                    <x-alert>{{$message}}</x-alert>
                    @enderror
                    <input type="text" name="nombre" placeholder="Nombre..." id="nombre"  value="{{$cuenta->nombre}}"  
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion</label>
                    @error('descripcion')
                    <x-alert>{{$message}}</x-alert>
                    @enderror
                    <input type="text" name="descripcion" placeholder="Descripcion..." id="descripcion"  value="{{$cuenta->descripcion}}"   
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_tipo_cuenta" class="block text-sm font-medium text-gray-700">
                        Tipo cuenta
                    </label>
                    @error('id_tipo_cuenta')
                    <x-alert>{{$message}}</x-alert>
                    @enderror
                    <select id="id_tipo_cuenta" name="id_tipo_cuenta" autocomplete="id_tipo_cuenta"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($tipo_cuentas as $item)
                        @if ($item->id == $cuenta->id_tipo_cuenta)
                            <option value="{{$item->id}}" selected>{{$item->id}}  {{$item->nombre}}</option>
                        @else 
                            <option value="{{$item->id}}" >{{$item->id}}  {{$item->nombre}}</option>
                        @endif
                        
                        @endforeach
                        
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_subtipo_cuenta" class="block text-sm font-medium text-gray-700">
                        Subtipo cuenta
                    </label>
                    @error('id_subtipo_cuenta')
                    <x-alert>{{$message}}</x-alert>
                    @enderror
                    <select id="id_subtipo_cuenta" name="id_subtipo_cuenta" autocomplete="id_subtipo_cuenta"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($subtipo_cuentas as $item)
                        @if ($item->id == $cuenta->id_subtipo_cuenta)
                            <option value="{{$item->id}}" selected>{{$item->id}}  {{$item->nombre}}</option>
                        @else 
                            <option value="{{$item->id}}" >{{$item->id}}  {{$item->nombre}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class=" flex justify-end pb-10 pr-20">
                    <button type="submit" class="pr-5 pl-5 mt-1 mb-15 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10 px-3 justify-center items-center">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        
    </div>  

  </x-app-layout>