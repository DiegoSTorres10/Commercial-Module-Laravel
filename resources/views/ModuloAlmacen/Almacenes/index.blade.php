@extends('layaout.plantilla')

@section('titulo', 'Catálogo Almacenes')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">
    
    
    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
@endsection

@section('subtitulo', 'Catálogo de Almacenes')

@section('contenido')

    <div class="container-fluid">

        @if(session()->has('updated_almacen'))
            <div class="alert alert-primary">
                {!! session()->get('updated_almacen') !!}
            </div>
        @elseif (session()->has('create_almacen'))
            <div class="alert alert-success">
                {!! session()->get('create_almacen') !!}
            </div>
        @elseif (session()->has('delete_almacen'))
            <div class="alert alert-secondary">
                {{ session('delete_almacen') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>

        @endif

        <a href="{{route('almacenes.create')}}" class="botones">
            <i class='bx bx-user-plus'></i>
            <span>Nuevo Almacen</span>
        </a>

        @livewire('almacenes-table')
        @livewireScripts

    </div>

@endsection
