@extends('layaout.plantilla')

@section('titulo', 'Catálogo productos')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">


    <link rel="stylesheet" href="{{ asset('css/Productos/Input.css') }}" type="text/css">

@endsection

@section('subtitulo', 'Actualizar producto ')

@section('contenido')



    <div class="container mt-3">

        @if (session()->has('update_lista'))
            <div class="alert alert-primary">
                {!! session()->get('update_lista') !!}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif


        <h4 class="mt-4"><strong>Información del producto</strong></h4>

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
                <input type="text" class="form-control mt-1 px-3" readonly id='ClaveProducto' name='ClaveProducto'
                    readonly value="{{ $Producto->ClaveProducto }}">
                @error('ClaveProducto')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21l18 0" />
                    <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                    <path d="M5 21l0 -10.15" />
                    <path d="M19 21l0 -10.15" />
                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                </svg>

                <label for="Nombre">Nombre*</label>
                <input type="text" class="form-control mt-1 px-3" id='Nombre' readonly name='Nombre'
                    value="{{ $Producto->Nombre }}">
                @error('Nombre')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-baseline-density-large"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4h16" />
                    <path d="M4 20h16" />
                </svg>

                <label for="IdTipo">Tipo </label>
                <input type="text" class="form-control mt-1 px-3" id='IdTipo' name='IdTipo' readonly
                    value="{{ $Producto->tipoSerProductos->Tipo }}">
                @error('IdTipo')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <h4 class="mt-5 px-5 my-auto"><strong>Lista de precios</strong></h4>



        <div class="table-responsive mt-1 mx-4">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Lista</th>
                        <th class="text-center">Porcentaje</th>
                        <th class="text-center">Precio Proveedor</th>
                        <th class="text-center">Precio Sugerido</th>

                        <th class="text-center">Seleccion </th>
                    </tr>
                </thead>
                <form id="myForm" autocomplete="off" method="POST" action="{{route('productosListas.updateListasProductos', $Producto)}}">
                    @csrf
                    @method('put')
                    <tbody>

                        <tr class="table-active">
                            <td class="text-center"> 0 </td>
                            <td class="text-center">
                                <input type="text" name="NombreLista" id="NombreLista" placeholder="Nombre Lista"
                                    class="custom-form-control">
                                @error('NombreLista')
                                    <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                        <strong>{{ $message }}</strong>
                                        
                                    </span>
                                @enderror 
                            </td>
                            <td class="text-center">
                                <input type="text" name="PorcentajeInput" id="PorcentajeInput"
                                    placeholder="Porcentaje" class="custom-form-control">
                                <input type="text" hidden name="Porcentaje" id="Porcentaje" placeholder="Porcentaje"
                                    class="custom-form-control">
                                @error('Porcentaje')
                                    <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                        <strong>{{ $message }}</strong>
                                        
                                    </span>
                                @enderror 
                            </td>
                            <td class="text-center" id="CostoProveedorTabla">

                            </td>

                            <td class="text-center" id="PrecioSugeridoTabla">

                            </td>
                            <td class="text-center">
                                <input type="radio" id="Seleccionada" name="listas[]" value="0">
                            </td>
                        </tr>

                        <input type="text" id="CostoProveedor" name="CostoProveedor"
                            value="{{ $ObjetoProductoProveedor->pivot->CostoProveedor }}" hidden>

                        @foreach ($ListaPrecios as $Lista)
                            @if ($Producto->IdLista == $Lista->IdLista)
                                <tr class="table-active">

                                    <td class="text-center"> {{ $Lista->IdLista }} </td>
                                    <td class="text-center"> {{ $Lista->NombreLista }} </td>
                                    <td class="text-center"> %{{ $Lista->Porcentaje }} </td>
                                    <td class="text-center">
                                        ${{ $ObjetoProductoProveedor->pivot->CostoProveedor }}
                                    </td>

                                    <td class="text-center">
                                        ${{ $ObjetoProductoProveedor->pivot->CostoProveedor * ($Lista->Porcentaje / 100 + 1) }}
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" id="{{ $Lista->IdLista }}" name="listas[]"
                                            value="{{ $Lista->IdLista }}" checked>
                                    </td>
                                </tr>
                            @else
                                <tr class="table-active">

                                    <td class="text-center"> {{ $Lista->IdLista }} </td>
                                    <td class="text-center"> {{ $Lista->NombreLista }} </td>
                                    <td class="text-center"> %{{ $Lista->Porcentaje }} </td>
                                    <td class="text-center">
                                        ${{ $ObjetoProductoProveedor->pivot->CostoProveedor }}
                                    </td>

                                    <td class="text-center">
                                        ${{ $ObjetoProductoProveedor->pivot->CostoProveedor * ($Lista->Porcentaje / 100 + 1) }}
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" id="{{ $Lista->IdLista }}" name="listas[]"
                                            value="{{ $Lista->IdLista }}">
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
            </table>
        </div>

            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $ListaPrecios->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $ListaPrecios->previousPageUrl() }}" tabindex="-1"
                                aria-disabled="true">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $ListaPrecios->lastPage(); $i++)
                            <li class="page-item {{ $ListaPrecios->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $ListaPrecios->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $ListaPrecios->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $ListaPrecios->nextPageUrl() }}">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>



            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="{{ route('productos.edit', $Producto) }}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                        <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>

                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                        <button class="boton2 mx-auto btn-block" id='Actualizar' type="submit">Actualizar Lista</button>
                    </div>
                </a>
            </div>
        </form>

        {{-- ================MOdal para si crea una lista debe tener un nombre y porcentaje========== --}}
        <div class="modal fade modal-custom" id="ErrorLista" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al
                                registrar la lista</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/error.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                            style="max-width: 150px;">
                        <p>No se pudo enviar los datos de la lista <br>
                            Debe tener el campo de nombre y el porcentaje </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    <script type="text/javascript" src="{{ asset('js/ModuloProductos/ListaProducto.js') }}"></script>

@endsection
