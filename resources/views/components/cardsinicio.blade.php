<div class="flex justify-center">
    <div class=" flex  flex-col   justify-center  flex-wrap gap-3 mt-3 mb-7 ml-5 mr-5 ">
        <div class="">
            <div class="bg-white  shadow-lg   mx-auto border-b-4 border-gray-700 rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                <div class="bg-gray-700 flex h-20  items-center ">
                    <h1 class="text-white ml-4 border-2 py-2 px-4 rounded-full">{{ $numero }}</h1>
                    <p class="ml-4 mr-4 text-white uppercase">{{ $titulo }}</p>
                </div>
                <p class="py-6 px-6 text-lg tracking-wide ">
                    {{ $descripcion }}
                    {{-- En esta seccion podras registrar editar y eliminar asientos contables --}}
                </p>
                              
                <div class="flex justify-center px-5 mb-2 text-sm ">
                    <a type="button" class="border border-gray-700 text-gray-700 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:text-white hover:bg-gray-500 focus:outline-none focus:shadow-outline" href="{{route($ruta)}}">{{ $boton }}</a> 
                </div>
            </div>
      </div>
    </div>    
</div>