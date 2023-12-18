@extends('layaout.plantilla')

@section('titulo', 'Catalago Clientes')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/botones.css')}}">


@endsection

@section('subtitulo', 'Alta de cliente ')

@section('contenido')

    <div class="container">
        @if(session()->has('update_DatosCliente'))
            <div class="alert alert-primary">
                {!! session()->get('update_DatosCliente') !!}
            </div>
        @elseif (session()->has('update_DatosCliente_Entregas'))
            <div class="alert alert-primary">
                {!! session()->get('update_DatosCliente_Entregas') !!}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        
        
    </div>

    <div class="container mt-3">
        <form action="{{route('clientes.update', $clientes)}}" method="POST" enctype="multipart/form-data" id="formulario" autocomplete="off">
            @csrf
            @method('put')

            <div class="row bg-black">

                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-12 mb-2">
                    
                    <label for="Clave">Clave</label>
                    <input type="text" class="form-control" id="Clave" name="Clave" value="{{$clientes->IdCliente}}" readonly>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    <label for="fecha">Fecha de Alta</label>
                    <input type="text" class="form-control" id="FechaAlta" name="FechaAlta" value="{{$clientes->FechaAlta}}" readonly>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    </svg>
                    <label for="RFC">RFC * </label>
                    <input type="text" class="form-control" id="RFC" readonly value="{{ $clientes->RFC }}" name="RFC" >
                    @error('RFC')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    </svg>
                    <label for="CURP">CURP</label>
                    <input type="text" class="form-control" id="CURP" readonly value="{{$clientes->CURP}}" name="CURP" >
                    @error('CURP')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <label for="NombreCompleto">Nombre Completo *</label>
                    <input type="text" class="form-control " id="NombreCompleto" readonly value="{{$clientes->NombreCompleto}}" name="NombreCompleto">
                    @error('NombreCompleto')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-question" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                        <path d="M19 22v.01" />
                        <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                    </svg>
                    <label for="TipoCliente">Tipo Cliente * </label>
                    <select class="form-control" id="TipoCliente" readonly name="TipoCliente">
                        <option value="" disabled>  --Seleccione un tipo de cliente--  </option>
                        @foreach ($TipoClientes as $TC)
                            @if ($clientes->ClaveTipo === $TC->ClaveTipo)
                                <option selected value="{{ $TC->ClaveTipo }}"> {{ $TC->Descripcion }} </option>
                            @else
                                <option value="{{ $TC->ClaveTipo }}"> {{ $TC->Descripcion }} </option>
                            @endif
                            
                        @endforeach
                    </select>
                    @error('TipoCliente')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 mb-2">
                    
                    <label for="Calle">Calle *</label>
                    <input type="text" class="form-control" id="Calle" readonly value="{{$clientes->Calle}}" name="Calle" >
                    @error('Calle')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    <label for="NoExterior">No. Exterior *</label>
                    <input type="text" class="form-control" id="NoExterior" readonly value="{{$clientes->NoExterior}}" name="NoExterior" >
                    @error('NoExterior')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    
                    <label for="NoInterior">No. Interior</label>
                    <input type="text" class="form-control" id="NoInterior" readonly value="{{ $clientes->NoInterior }}" name="NoInterior" >
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Colonia">Colonia *</label>
                    <input type="text" class="form-control " readonly id="Colonia"  value="{{ $clientes->Colonia }}" name="Colonia">
                    @error('Colonia')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    
                    <label for="Municipio">Municipio *</label>
                    <input type="text" class="form-control " id="Municipio"  readonly value="{{ $clientes->Municipio }}" name="Municipio">
                    @error('Municipio')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="Estado">Estado *</label>
                    <input type="text" class="form-control" id="Estado" value="{{ $clientes->Estado }}" readonly name="Estado" >
                    @error('Estado')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="Pais">País *</label>
                    <select class="form-control" id="Pais" name="Pais" readonly>
                        <option value="" disabled>  --Seleccione un país--  </option>
                        @foreach ($Paises as $pais)
                            @if ($clientes->ClavePais === $pais->ClavePais)
                                <option selected value="{{ $pais->ClavePais }}"> {{$pais->Pais}} [{{$pais->ClavePais}}]</option>
                            @else
                                <option value="{{ $pais->ClavePais }}"> {{$pais->Pais}} [{{$pais->ClavePais}}]</option>
                            @endif
                        @endforeach
                        
                    </select>
                    @error('Pais')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="CP">Código Postal *</label>
                    <input type="text" class="form-control" id="CP" readonly value="{{ $clientes->CP }}" name="CP" >
                    @error('CP')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                @foreach($clientes->telefonos as $index => $telefono)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="4" width="10" height="16" rx="1" />
                            <line x1="8" y1="5" x2="10" y2="5" />
                            <line x1="9" y1="17" x2="9" y2="17.01" />
                            <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                        </svg>

                        <label for="tel{{ $index + 1 }}">Teléfono {{ $index + 1 }}</label>
                        <input type="text" class="form-control" value="{{ $telefono->NumeroTelefonico }}" readonly id="tel{{ $index + 1 }}" name="tel{{ $index + 1 }}">
                    </div>

                    @error('tel{{ $index + 1 }}')
                        <span class="invalid-feedback" role="alert" style="text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endforeach
                @if($clientes->telefonos->count() <2)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="4" width="10" height="16" rx="1" />
                            <line x1="8" y1="5" x2="10" y2="5" />
                            <line x1="9" y1="17" x2="9" y2="17.01" />
                            <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                        </svg>
                        <label for="tel2">Teléfono 2</label>
                        <input type="text" class="form-control " value="{{ old('tel2') }}" id="tel2" readonly name="tel2">
                        @error('tel2')
                            <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                <strong>{{ $message }}</strong>
                                
                            </span>
                        @enderror
                    </div>
                @endif

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <polyline points="3 7 12 13 21 7" />
                    </svg>
                    <label for="Email">Email *</label>
                    <input type="email" class="form-control " id="Email" value="{{ $clientes->Email }}" name="Email" readonly>
                    @error('Email')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>
                <div id="msgCorreo"></div>

            </div>


            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="{{route('clientes.index')}}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>

                <div class="text-center mx-4 pb-1 mt-1 flex-fill" id="BDatosFiscalesDIV">
                    <button class="boton2 mx-auto btn-block" id="BDatosFiscales" type="button">Ver datos Facturación</button>
                </div>
                
                <div class="text-center mx-4 pb-1 mt-1 flex-fill" id="BDatosEntregasDIV">
                    <button class="boton2 mx-auto btn-block" id="BDatosEntregas" type="button">Ver datos Entrega</button>
                </div>

                <div class="text-center mx-4 pb-1 mt-1 flex-fill">
                    <button class="boton2 mx-auto btn-block" id="BModificar" type="button">Modificar Datos</button>
                </div>
                
                <a href="" class="d-none" id="BotonEnviar">
                    <div class="text-center mt-1  pb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="submit">Actualizar</button>
                    </div>
                </a>
            </div>

        </form>


        <div id="DatosFactura" class="mb-4">
            <script>
                var RutaFactura = '{{ route("DatosFactura.show") }}';
            </script>
        </div>

        <div id="DatosEntregas" class="mb-4">
            <script>
                var RutaEntregas = '{{ route("DatosEntregas.show") }}';
            </script>
        </div>


    </div>




@endsection




@section('js')
    <script type="text/javascript" src="{{ asset('js/ModuloClientes/ShowCliente.js') }}"></script>
@endsection
