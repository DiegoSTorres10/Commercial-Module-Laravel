@extends('layaout.plantilla')

@section('titulo', 'Catálogo productos')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">


@endsection

@section('subtitulo', 'Actualizar producto ')

@section('contenido')

    <div class="container mt-3">

        <h4 class="mt-4"><strong>Información del producto</strong></h4>
        <form action="{{route('productos.updateDatosProducto', $Producto)}}" method="POST" enctype="multipart/form-data" id="formulario" autocomplete="off">
            @method('put')
            @csrf

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                        <path d="M15 9h.01" />
                    </svg>

                    <label for="ClaveProducto">Clave </label>
                    <input type="text" class="form-control mt-1 px-3" id='ClaveProducto' name='ClaveProducto' readonly
                        value="{{ $Producto->ClaveProducto }}">
                    @error('ClaveProducto')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l18 0" />
                        <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                        <path d="M5 21l0 -10.15" />
                        <path d="M19 21l0 -10.15" />
                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                    </svg>

                    <label for="Nombre">Nombre*</label>
                    <input type="text" class="form-control mt-1 px-3" id='Nombre' name='Nombre'
                        value="{{ $Producto->Nombre }}">
                    @error('Nombre')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-baseline-density-large mx-3"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 4h16" />
                        <path d="M4 20h16" />
                    </svg>

                    <label for="IdTipo" class="">Tipo* </label>
                    <div class="mt-2 px-4">
                        @foreach ($TipoProd as $TPS)
                            @if ($TPS->IdTipo == $Producto->IdTipo)
                                <input class="form-check-input" checked type="radio" name="IdTipo" id="IdTipo"
                                    value="{{ $TPS->IdTipo }}"> {{ $TPS->Tipo }}
                                <label class="form-check-label mx-2" for="IdTipo">
                                </label>
                            @else
                                <input class="form-check-input" type="radio" name="IdTipo" id="IdTipo"
                                    value="{{ $TPS->IdTipo }}"> {{ $TPS->Tipo }}
                                <label class="form-check-label mx-2" for="IdTipo">
                                </label>
                            @endif
                        @endforeach
                    </div>
                    @error('IdTipo')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="Clasificador">Clasificador* </label>
                    <input type="text" class="form-control mt-1 px-3" id='Clasificador' name='Clasificador'
                        value="{{ $Producto->Clasificador }}">
                    @error('Clasificador')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="UnidadMedida">Unidad de Medida* </label>
                    <input type="text" class="form-control mt-1 px-3" id='UnidadMedida' name='UnidadMedida'
                        value="{{ $Producto->UnidadMedida }}">
                    @error('UnidadMedida')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-vocabulary"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                        <path d="M12 5v16" />
                        <path d="M7 7h1" />
                        <path d="M7 11h1" />
                        <path d="M16 7h1" />
                        <path d="M16 11h1" />
                        <path d="M16 15h1" />
                    </svg>

                    <label for="Descripcion">Descipcion </label>
                    <textarea name="Descripcion" class="form-control px-3" id="Descripcion" cols="" rows="2"> {{ $Producto->Descripcion }} </textarea>
                    @error('Descripcion')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="submit">Actualizar producto</button>
                    </div>
                </a>
            </div>

        </form>






        <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
            <a href="{{ route('productos.index') }}">
                <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                </div>
            </a>

            <a href="{{route('productosProveedores.EditProveedor', $Producto)}}">
                <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="button">Modificar el proveedor</button>
                </div>
            </a>

            <a href="{{route('productosListas.showListasProductos', $Producto)}}">
                <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                <button class="boton2 mx-auto btn-block" type="button">Modificar lista precios</button>
                </div>
            </a>


        </div>

    </div>

@endsection


@section('js')

@endsection
