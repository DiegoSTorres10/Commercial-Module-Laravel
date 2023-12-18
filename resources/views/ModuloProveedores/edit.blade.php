@extends('layaout.plantilla')

@section('titulo', 'Catálogo Proveedores')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">


@endsection

@section('subtitulo', 'Editar proveedor ')

@section('contenido')

    <div class="container mt-5 ">


        <form action="{{ route('proveedores.update', $Proveedor) }}" method="POST" enctype="multipart/form-data"
            id="formulario" autocomplete="off">
            @csrf
            @method('put')


            <div class="row mt-3">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                    </svg>

                    <label for="NombreComercial">Nombre Comercial* </label>
                    <input type="text" class="form-control" id="NombreComercial" name="NombreComercial"
                        value="{{ $Proveedor->NombreComercial }}">
                    @error('NombreComercial')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                    </svg>

                    <label for="GrupoEmpresarial">Grupo Empresarial* </label>
                    <input type="text" class="form-control" id="GrupoEmpresarial" name="GrupoEmpresarial"
                        value="{{ $Proveedor->GrupoEmpresarial }}">
                    @error('GrupoEmpresarial')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="10" height="16" rx="1" />
                        <line x1="8" y1="5" x2="10" y2="5" />
                        <line x1="9" y1="17" x2="9" y2="17.01" />
                        <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                    </svg>

                    <label for="Telefono">Teléfono </label>
                    <input type="text" class="form-control" id="Telefono" name="Telefono" value="{{ $Proveedor->Telefono }}">
                    @error('Telefono')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <polyline points="3 7 12 13 21 7" />
                    </svg>

                    <label for="CorreoElectronico">Correo Electrónico </label>
                    <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico"
                        value="{{ $Proveedor->CorreoElectronico }}">
                    @error('CorreoElectronico')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>

                        </span>
                    @enderror
                </div>

            </div>

            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="{{ route('proveedores.index') }}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                        <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>

                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                        <button class="boton2 mx-auto btn-block" type="submit">Actualizar
                            proveedor</button>
                    </div>
                </a>
            </div>
        </form>
    </div>
    </div>
@endsection

@section('js')

@endsection
