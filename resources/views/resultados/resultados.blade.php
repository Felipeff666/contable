
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resultados') }}
        </h2>
    </x-slot>

    <div class="flex justify-center ml-20 mr-10 mt-5 ">
        <a type="button"class=" pr-5 pl-5 ml-3 mr-3  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('resultados/pdf')}}">Generar PDF del informe de estados financieros  </a>
        <a type="button"class=" pr-5 pl-5 ml-3 mr-3  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('resultados/ldiario/pdf')}}">Generar informe del libro diario PDF</a>
        <a type="button"class=" pr-5 pl-5 ml-3 mr-3  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('resultados/lmayor/pdf')}}">Generar informe del libro mayor PDF</a>
    </div>  

    <div class="flex  justify-center mt-4 ml-4 mr-4" >
        
        <div>
            <x-cardsinicio ruta="balance_general">
                <x-slot name="numero" >1</x-slot>
                <x-slot name="titulo">balance general</x-slot>
                <x-slot name="descripcion">  En esta seccion usted podra revisar los resultados del balance general  </x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            <x-cardsinicio ruta="estado_de_resultados">
                <x-slot name="numero" >3</x-slot>
                <x-slot name="titulo">Estado de resultados</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra revisar el estados de resultados y utilidad neta</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            <x-cardsinicio ruta="res_libro_diario">
                <x-slot name="numero" >5</x-slot>
                <x-slot name="titulo">Libro diario</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra revisar los asientos y resultados del libro diario</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            
        </div>
        <div >
            <x-cardsinicio ruta="balanza_de_comprobacion">
                <x-slot name="numero" >2</x-slot>
                <x-slot name="titulo">Balanza de comprobación</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra revisar la balanza de comprobacion</x-slot>
                <x-slot name="boton">ingresar</x-slot>                                   
            </x-cardsinicio>
            <x-cardsinicio ruta="estado_de_capital">
                <x-slot name="numero" >4</x-slot>
                <x-slot name="titulo">Estado del capital contable</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra revisar el estado del capital contable</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            <x-cardsinicio ruta="res_libro_mayor">
                <x-slot name="numero" >6</x-slot>
                <x-slot name="titulo">Libro mayor</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra revisar los resultados del libro mayor</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
        </div>       
          
    </div>  
   

</x-app-layout>