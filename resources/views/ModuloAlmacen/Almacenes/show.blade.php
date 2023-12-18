@extends('layaout.plantilla')

@section('titulo', 'Catálogo de Almacén')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/botones.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

@endsection

@section('subtitulo', 'Editar Almacén ')

@section('contenido')

    <div class="container mt-3">

            <h4 class="mt-5"><strong>Datos Almacén</strong></h4>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                    <label for="Id">Id</label>
                    <input type="text" class="form-control " id="Id" readonly value="{{ $Almacen->IdAlmacen }}" name="Id">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="NombreAlmacen">Almacen </label>
                    <input type="text" class="form-control " id="NombreAlmacen" readonly value="{{ $Almacen->NombreAlmacen }}" name="NombreAlmacen">
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="NumeroTelefonico">Número Telefónico</label>
                    <input type="text" class="form-control " id="NumeroTelefonico" readonly value="{{ $Almacen->NumeroTelefonico }}" name="NumeroTelefonico">

                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    
                    <label for="DescripcionAlmacen">Descripción</label>
                    <textarea name="DescripcionAlmacen" class="form-control" id="DescripcionAlmacen" readonly  rows="4">{{$Almacen->DescripcionAlmacen}}</textarea>
                    
                </div>
            </div>


            <h4 class="mt-4"><strong>Datos Ubicación</strong></h4>
            <div class="row mt-3">

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 mb-2">
                    <label for="Calle">Calle </label>
                    <input type="text" class="form-control" id="Calle" value="{{ $Almacen->Calle }}" readonly name="Calle" >
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    <label for="NoExterior">No. Exterior </label>
                    <input type="text" class="form-control" id="NoExterior" value="{{ $Almacen->NoExterior }}" readonly name="NoExterior" >
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    
                    <label for="NoInterior">No. Interior</label>
                    <input type="text" class="form-control" id="NoInterior"  value="{{ $Almacen->NoInterior }}" readonly name="NoInterior" >
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Colonia">Colonia </label>
                    <input type="text" class="form-control " id="Colonia"  value="{{ $Almacen->Colonia }}" readonly name="Colonia">
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    
                    <label for="Municipio">Municipio </label>
                    <input type="text" class="form-control " id="Municipio"  value="{{ $Almacen->Municipio }}" readonly name="Municipio">

                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="Estado">Estado </label>
                    <input type="text" class="form-control" id="Estado" value="{{ $Almacen->Estado }}" readonly name="Estado" >

                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="ClavePais">País </label>
                    <input type="text" id="ClavePais" class="form-control" readonly value="{{$Almacen->paises->Pais}}">
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="CP">Código Postal </label>
                    <input type="text" class="form-control" id="CP" value="{{ $Almacen->CP }}" readonly name="CP" >
                    
                </div>

            </div>




            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-4 mb-5">
                <a href="{{route('almacenes.index')}}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>
                
            </div>
    </div>

@endsection

