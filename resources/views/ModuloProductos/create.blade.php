@extends('layaout.plantilla')


@section('titulo', 'Nuevo Producto')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@endsection

@section('subtitulo', 'Nuevo producto ')

@section('contenido')

    <div class="container ">
        <h4 class="mt-5 pt-2"><strong>Información del producto/servicio</strong></h4>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">


                <label for="ClaveProducto">Clave Producto* </label>
                <input type="text" class="form-control" id="ClaveProducto" name="ClaveProducto"
                    value="{{ old('ClaveProducto') }}">

                @error('ClaveProducto')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div id="ErrorClave"></div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                <label for="IdTipo" class="mx-4">Tipo* </label>
                <div class="mt-2 px-3">
                    @foreach ($TipoProd as $TPS)
                        <input class="form-check-input" type="radio" name="IdTipo" id="IdTipo"
                            value="{{ $TPS->IdTipo }}"> {{ $TPS->Tipo }}
                        <label class="form-check-label mx-2" for="IdTipo">
                        </label>{{--  --}}
                    @endforeach
                </div>
                @error('IdTipo')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorTipo"></div>
            </div>

            
        </div>

        <div class="row mt-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                <label for="Clasificador">Clasificador* </label>
                <input type="text" class="form-control" id="Clasificador" name="Clasificador"
                    value="{{ old('Clasificador') }}">

                @error('Clasificador')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorClasificador"></div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                <label for="UnidadMedida">Unidad de Medida* </label>
                <input type="text" class="form-control" id="UnidadMedida" name="UnidadMedida"
                    value="{{ old('UnidadMedida') }}">
                @error('UnidadMedida')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorMedida"></div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                <label for="Nombre">Nombre* </label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{ old('Nombre') }}">

                @error('Nombre')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorNombre"></div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                <label for="Descripcion">Descripcion </label>
                <input type="text" class="form-control" id="Descripcion" name="Descripcion"
                    value="{{ old('Descripcion') }}">

                @error('Descripcion')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorDescripcion"></div>
            </div>


        </div>



        <h4 class="mt-4"><strong>Información del proveedor</strong></h4>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-2">
                <label for="FechaCotizacion">Fecha Cotización</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="FechaCotizacion" value="{{ old('FechaCotizacion') }}"
                        name="FechaCotizacion" />
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="datepicker">
                        <i class="bi bi-calendar"></i>
                    </button>
                </div>
                @error('FechaCotizacion')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>

                    </span>
                @enderror
                <div id="ErrorFecha"></div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                <label for="IdProveedor">Proveedor* </label>
                <select name="IdProveedor" class="form-control text-center" id="IdProveedor">
                    <option value="" selected disabled> --Seleccione el proveedor-- </option>
                    @foreach ($Proveedores as $pro)
                        @if ($pro->IdProveedor == old('IdProveedor'))
                            <option value="{{ $pro->IdProveedor }}" selected>{{ $pro->NombreComercial }}</option>
                        @else
                            <option value="{{ $pro->IdProveedor }}">{{ $pro->NombreComercial }}</option>
                        @endif
                    @endforeach
                </select>
                @error('IdProveedor')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorProveedor"></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                <label for="CostoProveedor">Costo Proveedor* </label>
                <input type="text" class="form-control" id="CostoProveedor" name="CostoProveedor"
                    value="{{ old('ClaveProducto') }}">

                @error('CostoProveedor')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorCosto"></div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                <label for="IdTipoMoneda" class="mx-4">Tipo Moneda* </label>
                <select name="IdTipoMoneda" class="form-control text-center" id="IdTipoMoneda">
                    <option value="" selected disabled> --Seleccione el tipo de moneda-- </option>
                    @foreach ($TiposMoneda as $tm)
                        @if ($tm->IdTipoMoneda == old('IdTipoMoneda'))
                            <option value="{{ $tm->IdTipoMoneda }}" selected>{{ $tm->TipoMoneda }} --
                                [{{ $tm->IdTipoMoneda }}]</option>
                        @else
                            <option value="{{ $tm->IdTipoMoneda }}">{{ $tm->TipoMoneda }} -- [{{ $tm->IdTipoMoneda }}]
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('IdTipoMoneda')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="ErrorMoneda"></div>
            </div>


        </div>



    </div>




    <div id="ruta-siguiente" data-url="{{ route('productos.createListas') }}"></div>

    <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-4 pb-5">
        <a href="{{ route('productos.index') }}">
            <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
            </div>
        </a>

        <a href="">
            <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                <button class="boton2 mx-auto btn-block " type="button" id="Siguiente">Siguiente</button>
            </div>
        </a>
    </div>


@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/ModuloProductos/Alta.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
