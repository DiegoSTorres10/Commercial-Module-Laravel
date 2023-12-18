@extends('layaout.plantilla')

@section('titulo', 'Nuevo Producto')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/Productos/Input.css') }}" type="text/css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@endsection

@section('subtitulo', 'Nuevo producto ')

@section('contenido')

    <div class="container ">


        <h4 class="mt-5 pt-2 px-5 my-auto"><strong>Lista de precios</strong></h4>



        <div class="table-responsive mt-4 mx-4">
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
                <form id="myForm" autocomplete="off">
                    @csrf
                    <tbody>

                        <tr class="table-active">
                            <td class="text-center"> 0 </td>
                            <td class="text-center">
                                <input type="text" name="NombreLista" id="NombreLista" placeholder="Nombre Lista"
                                    class="custom-form-control">
                            </td>
                            <td class="text-center">
                                <input type="text" name="Porcentaje" id="Porcentaje" placeholder="Porcentaje"
                                    class="custom-form-control">
                            </td>
                            <td class="text-center" id="CostoProveedorTabla">
                            
                            </td>

                            <td class="text-center" id="PrecioSugeridoTabla">

                            </td>
                            <td class="text-center">
                                <input type="radio" id="Seleccionada" name="listas[]" value="0">
                            </td>
                        </tr>

                        @foreach ($ListaPrecios as $Lista)
                            <tr class="table-active">

                                <td class="text-center"> {{ $Lista->IdLista }} </td>
                                <td class="text-center"> {{ $Lista->NombreLista }} </td>
                                <td class="text-center"> %{{ $Lista->Porcentaje }} </td>
                                <td class="text-center">
                                    ${{ $Produc['CostoProveedor'] }}
                                </td>

                                <td class="text-center">
                                    ${{ $Produc['CostoProveedor'] + ($Lista->Porcentaje * $Produc['CostoProveedor']) / 100 }}
                                </td>
                                <td class="text-center">
                                    <input type="radio" id="{{ $Lista->IdLista }}" name="listas[]"
                                        value="{{ $Lista->IdLista }}">
                                </td>



                            </tr>
                        @endforeach
                    </tbody>
                </form>

            </table>
        </div>


        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $ListaPrecios->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $ListaPrecios->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
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


    </div>

    <div id="ruta" data-url="{{ route('lista.store') }}"></div>
    <div id="NuevoProducto" data-url="{{ route('productos.store') }}"></div>
    <div id="Finalizado" data-url="{{ route('productos.index') }}"></div>







    <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-4 mb-5">
        <a href="" id="botonRegresar">
            <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
            </div>
        </a>

        <a href="">
            <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                <button class="boton2 mx-auto btn-block " type="button" id="Enviar">Enviar</button>
            </div>
        </a>
    </div>



    {{-- ==============Modal para el error de seleccion de alguna lista  --}}
    <div class="modal fade modal-custom" id="ErrorEnviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al enviar
                            los datos</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/error.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                        style="max-width: 150px;">
                    <p>No se pudo enviar los datos <br>
                        Debe seleccionar una lista de precios </p>
                </div>
            </div>
        </div>
    </div>



    {{-- ================MOdal para si crea una lista debe tener un nombre y porcentaje========== --}}
    <div class="modal fade modal-custom" id="ErrorLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <p>No se pudo enviar los datos la lista <br>
                        Debe tener el campo de nombre y el porcentaje </p>
                </div>
            </div>
        </div>
    </div>



    {{-- ================MOdal para  algun error ========== --}}
    <div class="modal fade modal-custom" id="Error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al procesar la solicitud</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/error.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                        style="max-width: 150px;">
                    <p>Se ha presentado un error, intentelo más tarde </p>
                </div>
            </div>
        </div>
    </div>




    {{-- ================MOdal para exito del proceso del guardar ========== --}}
    <div class="modal fade modal-custom" id="Congratulations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Éxito en el proceso</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/exito.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                        style="max-width: 150px;">
                    <p>Se ha guardado con éxito el producto </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/ModuloProductos/AltaLista.js') }}"></script>
@endsection
