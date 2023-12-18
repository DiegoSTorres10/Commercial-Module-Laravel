@extends('layaout.plantilla')

@section('titulo', 'Catálogo Clientes')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">
    
    
    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
@endsection

@section('subtitulo', 'Catálogo de Clientes')

@section('contenido')

    <div class="container-fluid">

        @if(session()->has('update_Cliente'))
            <div class="alert alert-primary">
                {!! session()->get('update_Cliente') !!}
            </div>
        @elseif (session()->has('create_Cliente'))
            <div class="alert alert-success">
                {!! session()->get('create_Cliente') !!}
            </div>
        @elseif (session()->has('deleted_Cliente'))
            <div class="alert alert-secondary">
                {{ session('deleted_Cliente') }}
            </div>
        @endif

        <a href="{{route('clientes.create')}}" class="botones">
            <i class='bx bx-user-plus'></i>
            <span>Nuevo Clientes</span>
        </a>

        @livewire('cliente-tabla')
        @livewireScripts
    </div>

@endsection
