@extends('layaout.plantilla')

@section('titulo', 'Cotización')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">
    
    
    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
@endsection

@section('subtitulo', 'Cotizaciones')

@section('contenido')

    <div class="container-fluid">

       @if (session()->has('deleted_Cotizacion'))
            <div class="alert alert-secondary">
                {{ session('deleted_Cotizacion') }}
            </div>
        @endif

        <a href="{{route('cotizaciones.create')}}" class="botones">
            <i class='bx bx-money-withdraw'></i>
            <span>Nueva Cotización</span>
        </a>

        @livewire('cotizaciones')
        @livewireScripts
    </div>

@endsection
