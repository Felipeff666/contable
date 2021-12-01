
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>
    <div class="flex justify-center mt-4" >
        <div >
            <x-cardsinicio ruta="asiento_contable">
                <x-slot name="numero" >1</x-slot>
                <x-slot name="titulo">Asientos contables</x-slot>
                <x-slot name="descripcion">En esta seccion usted podra registrar, editar y eliminar un asiento contable</x-slot>
                <x-slot name="boton">ingresar</x-slot>                                   
            </x-cardsinicio>
            <x-cardsinicio ruta="libro_diario">
                <x-slot name="numero" >2</x-slot>
                <x-slot name="titulo">Libro diario</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra registrar, editar y eliminar un libro diario segun <br>sea necesario</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
            <x-cardsinicio ruta="libro_mayor">
                <x-slot name="numero" >3</x-slot>
                <x-slot name="titulo">Libro Mayor</x-slot>
                <x-slot name="descripcion"> En esta seccion usted podra registrar, editar y eliminar un libro mayor segun <br>sea necesario</x-slot>
                <x-slot name="boton">ingresar</x-slot>
            </x-cardsinicio>
        </div>   
    </div>    

</x-app-layout>
