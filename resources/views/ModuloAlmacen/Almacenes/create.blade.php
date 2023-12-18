@extends('layaout.plantilla')

@section('titulo', 'Catalago Almacén')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">


@endsection

@section('subtitulo', 'Alta de Almacén ')

@section('contenido')

    <div class="container mt-3">
        <form action="{{ route('almacenes.store') }}" method="POST" enctype="multipart/form-data" id="formulario"
            autocomplete="off">
            @csrf


            <h4 class="mt-5"><strong>Datos Almacén</strong></h4>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="NombreAlmacen">Almacen *</label>
                    <input type="text" class="form-control " id="NombreAlmacen" value="{{ old('NombreAlmacen') }}"
                        name="NombreAlmacen">
                    @error('NombreAlmacen')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="NumeroTelefonico">Número Telefónico *</label>
                    <input type="text" class="form-control " id="NumeroTelefonico" value="{{ old('NumeroTelefonico') }}"
                        name="NumeroTelefonico">
                    @error('NumeroTelefonico')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                    <label for="DescripcionAlmacen">Descripción</label>
                    <textarea name="DescripcionAlmacen" class="form-control" id="DescripcionAlmacen" cols="30" rows="2">{{ old('DescripcionAlmacen') }}</textarea>
                    @error('DescripcionAlmacen')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>
            </div>


            <h4 class="mt-4"><strong>Datos Ubicación</strong></h4>
            <div class="row mt-3">

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 mb-2">

                    <label for="Calle">Calle </label>
                    <input type="text" class="form-control" id="Calle" value="{{ old('Calle') }}" name="Calle">
                    @error('Calle')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    <label for="NoExterior">No. Exterior </label>
                    <input type="text" class="form-control" id="NoExterior" value="{{ old('NoExterior') }}"
                        name="NoExterior">
                    @error('NoExterior')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">

                    <label for="NoInterior">No. Interior</label>
                    <input type="text" class="form-control" id="NoInterior" value="{{ old('NoInterior') }}"
                        name="NoInterior">
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Colonia">Colonia </label>
                    <input type="text" class="form-control " id="Colonia" value="{{ old('Colonia') }}" name="Colonia">
                    @error('Colonia')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                    <label for="Municipio">Municipio </label>
                    <input type="text" class="form-control " id="Municipio" value="{{ old('Municipio') }}"
                        name="Municipio">
                    @error('Municipio')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="Estado">Estado </label>
                    <input type="text" class="form-control" id="Estado" value="{{ old('Estado') }}" name="Estado">
                    @error('Estado')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="ClavePais">País </label>
                    <select class="form-control text-center" id="ClavePais" name="ClavePais">
                        <option value="" selected disabled> --Seleccione un país-- </option>
                        @foreach ($Paises as $pais)
                            @if (old('Pais') == $pais->ClavePais)
                                <option value="{{ $pais->ClavePais }}" selected> {{ $pais->Pais }}
                                    [{{ $pais->ClavePais }}]</option>
                            @else
                                <option value="{{ $pais->ClavePais }}"> {{ $pais->Pais }} [{{ $pais->ClavePais }}]
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('ClavePais')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="CP">Código Postal </label>
                    <input type="text" class="form-control" id="CP" value="{{ old('CP') }}"
                        name="CP">
                    @error('CP')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

            </div>




            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-4 mb-5">
                <a href="{{ route('almacenes.index') }}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                        <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>

                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                        <button class="boton2 mx-auto btn-block" type="submit">Agregar nuevo almacén </button>
                    </div>
                </a>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            jQuery("#CP").on('input', function() {
                jQuery(this).val(jQuery(this).val().replace(/[^0-9]+$/g, ''));
            });
        })
    </script>
@endsection
