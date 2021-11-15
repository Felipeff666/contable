<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Insertar libro mayor') }}
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('libro_mayor')}}">volver</a>
    </x-slot>
   
    <div class="mr-10 ml-10 mt-4 bg-gray-200 h-full">
        <div class="w-full h-14 pt-2 text-center  bg-gray-700  shadow overflow-hidden sm:rounded-md font-bold text-3xl text-white ">
            Registro de libros mayores
        </div>

        <section class="flex justify-center text-gray-900 body-font  m-0 p-0 relative ">
            Por favor ingrese todos lo datos necesarios
        </section>
        <div class="p-30">
            <form action="{{route('libro_mayor/editar/edit',$libros_mayores)}}" method="POST" >
                @csrf
                @method('put')
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="nombre_denominacion" class="block text-sm font-medium text-gray-700">Nombre denominacion</label>
                    @error('nombre_denominacion')
                        <x-alert>{{$message}}</x-alert>
                    @enderror
                    <input type="text" name="nombre_denominacion" placeholder="numero..." id="nombre_denominacion" value="{{$libros_mayores->nombre_denominacion}}"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="gestion" class="block text-sm font-medium text-gray-700">Gestion</label>
                    @error('gestion')
                        <x-alert>{{$message}}</x-alert>
                    @enderror
                    <input type="date" name="gestion" placeholder="Gestion..." id="gestion"  value="{{$libros_mayores->gestion}}"   
                        class="mt-1 text-gray-400 hover:text-gray-700 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <input id="id_user" name="id_user" type="hidden" value="{{Auth::user()->id}}">
                <div class=" flex justify-end pb-10 pr-20">
                    <button class="pr-5 pl-5 mt-1 mb-15 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10 px-3 justify-center items-center">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        
    </div>  

  </x-app-layout>