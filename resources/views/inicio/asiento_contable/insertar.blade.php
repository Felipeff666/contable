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
            <form action="#" method="POST" >
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="numero_asiento" class="block text-sm font-medium text-gray-700">Numero de asiento</label>
                    <input type="text" name="numero_asiento" placeholder="numero..." id="numero_asiento"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" placeholder="" id="fecha"
                        class="mt-1 text-gray-400 hover:text-gray-700 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="banderas" class="block text-sm font-medium text-gray-700">Banderas</label>
                    <input type="text" name="banderas" placeholder="A+/A-/Q+/Q-/P+/P-/I+/I-/G+/G-" id="banderas"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="deber" class="block text-sm font-medium text-gray-700">Deber</label>
                    <input type="number" name="deber" placeholder="monto..." id="deber"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="heber" class="block text-sm font-medium text-gray-700">Heber</label>
                    <input type="number" name="heber" placeholder="monto..." id="heber"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_diario" class="block text-sm font-medium text-gray-700">
                        Libro diario</label>
                    <select id="id_diario" name="id_diario" autocomplete="id_diario"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option>Libro diario 1</option>
                        <option>Libro diario 2</option>
                        <option>Libro diario 3</option>
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-3 col-span-6 sm:col-span-3">
                    <label for="id_mayor" class="block text-sm font-medium text-gray-700">
                        Libro mayor</label>
                    <select id="id_mayor" name="id_mayor" autocomplete="id_mayor"
                       
                        class="mt-1 text-gray-800 py-2 px-3 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option>Libro mayor 1</option>
                        <option>Libro mayor 2</option>
                        <option>Libro mayor 3</option>
                    </select>
                </div>
                <div class=" ml-20 mr-20 mt-3 mb-10 col-span-6 sm:col-span-3">
                    <label for="glosa" class="block text-sm font-medium text-gray-700">Glosa</label>
                    <input type="text" name="glosa" placeholder="glosa..." id="glosa"     
                        class="mt-1 text-gray-800 focus:border-gray-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class=" flex justify-end pb-10 pr-20">
                    <button class="pr-5 pl-5 mt-1 mb-15 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10 px-3 justify-center items-center">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        
    </div>  

  </x-app-layout>