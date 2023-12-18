@extends('layaout.plantilla')

@section('titulo', 'Inventario')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
@endsection

@section('subtitulo', 'Consulta Inventario')

@section('contenido')

    <div class="container-fluid px-5">

        @livewire('consulta-inventario')

    </div>



@endsection
    @livewireScripts
@section('js')
