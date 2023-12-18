@extends('layaout.plantilla')

@section('titulo', 'Catálogo Proveedores')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">
    

    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
@endsection

@section('subtitulo', 'Catálogo Proveedores')

@section('contenido')

    <div class="container-fluid px-5">

        @if(session()->has('update_proveedor'))
            <div class="alert alert-primary">
                {!! session()->get('update_proveedor') !!}
            </div>
        @elseif (session()->has('create_proveedor'))
            <div class="alert alert-success">
                {!! session()->get('create_proveedor') !!}
            </div>
        @elseif (session()->has('delete_proveedor'))
            <div class="alert alert-secondary">
                {{ session('delete_proveedor') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif

        <div class="container-fluid">
            <a href="{{route('proveedores.create')}}" class="botones">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span>Nuevo Proveedor</span>
            </a>
        </div>

        
        @livewire('proveedores-tabla')

    </div>

    

@endsection
    @livewireScripts
@section('js')

