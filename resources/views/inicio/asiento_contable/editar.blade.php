<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de asientos contables') }}
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('asiento_contable')}}">volver</a>
    </x-slot>
   
    <div class="mr-10 ml-10 mt-4 bg-gray-200 h-full">
        <div class="w-full h-14 pt-2 text-center  bg-gray-700  shadow overflow-hidden sm:rounded-md font-bold text-3xl text-white ">
            Registro de asientos contables
        </div>

        <section class="flex justify-center text-gray-900 body-font  m-0 p-0 relative ">
            Por favor ingrese todos lo datos necesarios
        </section>
        <div class="p-30">
            <form action="{{route('asiento_contable/editar/edit',$asiento_contable)}}" method="POST" >
                @csrf
                @method('put')
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="numero_asiento" class="block text-sm font-medium text-gray-700">Numero de asiento</label>
                    @error('numero_asiento')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="number" name="numero_asiento" placeholder="numero..." id="numero_asiento" min="0" value="{{$asiento_contable->numero_asiento}}"      
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    @error('fecha')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="date" name="fecha" placeholder="" id="fecha" value="{{$asiento_contable->fecha}}"
                        class="mt-1 text-gray-400 hover:text-gray-700 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="banderas" class="block text-sm font-medium text-gray-700">Banderas</label>
                    @error('banderas')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="text" name="banderas" placeholder="A+/A-/Q+/Q-/P+/P-/I+/I-/G+/G-" id="banderas"   value="{{$asiento_contable->banderas}}"  
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="deber" class="block text-sm font-medium text-gray-700">Deber</label>
                    @error('deber')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="number" name="deber" placeholder="monto..." id="deber"  min="0"  value="{{$asiento_contable->deber}}" 
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="haber" class="block text-sm font-medium text-gray-700">Haber</label>
                    @error('haber')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="number" name="haber" placeholder="monto..." id="haber"   min="0"  value="{{$asiento_contable->haber}}"
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_cuenta" class="block text-sm font-medium text-gray-700">
                        Cuenta</label>
                    @error('id_cuenta')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <select id="id_cuenta" name="id_cuenta" autocomplete="id_cuenta"
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($cuentas as $item)
                            @if ($item->id == $asiento_contable->id_cuenta)
                                 <option value="{{$item->id}}" selected>{{$item->nombre}}</option>
                            @else
                            <option value="{{$item->id}}" >{{$item->nombre}}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_diario" class="block text-sm font-medium text-gray-700">
                        Libro diario</label>
                    @error('id_diario')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror    
                    <select id="id_diario" name="id_diario" autocomplete="id_diario"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($libros_diarios as $item)
                            @if ($item->id == $asiento_contable->id_diario)
                            <option value="{{$item->id}}" selected>{{$item->nombre_denominacion}}/ fecha apertura:{{$item->fecha_apertura}}/ fecha cierre:{{$item->fecha_cierre}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->nombre_denominacion}}/ fecha apertura:{{$item->fecha_apertura}}/ fecha cierre:{{$item->fecha_cierre}}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_mayor" class="block text-sm font-medium text-gray-700">
                        Libro mayor</label>
                    @error('id_mayor')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <select id="id_mayor" name="id_mayor" autocomplete="id_mayor"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @foreach ($libros_mayores as $item)
                            @if ($item->id == $asiento_contable->id_mayor)
                            <option value="{{$item->id}}" selected>{{$item->nombre_denominacion}}/ Gestion:{{$item->gestion}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->nombre_denominacion}}/ Gestion:{{$item->gestion}}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-10 col-span-6 sm:col-span-3">
                    <label for="glosa" class="block text-sm font-medium text-gray-700">Glosa</label>
                    @error('glosa')
                        <x-alert>{{$message}}</x-alert> 
                    @enderror
                    <input type="text" name="glosa" placeholder="glosa..." id="glosa"  value="{{$asiento_contable->glosa}}"   
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <input id="id_user" name="id_user" type="hidden" value="{{Auth::user()->id}}">
                <div class=" flex justify-end pb-10 pr-20">
                    <button type="submit" class="pr-5 pl-5 mt-1 mb-15 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10 px-3 justify-center items-center">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        
    </div>  

  </x-app-layout>