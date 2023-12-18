@extends('layaout.plantilla')

@section('titulo', 'Seguimiento Notas')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/botones.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

@endsection

@section('subtitulo', 'Nueva nota ')

@section('contenido')

    <div class="container mt-3">

        


        <form action="{{route('notas.store')}}" method="POST" enctype="multipart/form-data" id="formulario" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                    </svg>

                    <label for="IdCliente">Seleccione el cliente* </label>
                    <select name="IdCliente" class="form-control text-center mt-2" id="IdCliente">
                        <option value="" disabled selected>   -- Seleccione al cliente --   </option>
                        @foreach ($Clientes as $cliente)
                            @if ($cliente->IdCliente == old('IdCliente'))
                                <option value="{{$cliente->IdCliente}}" selected>{{$cliente->NombreCompleto}}</option>
                            @else
                                <option value="{{$cliente->IdCliente}}">{{$cliente->NombreCompleto}}</option>
                            @endif
                            
                        @endforeach
                    </select>

                    @error('IdCliente')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mt-5 border border-4 rounded">
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-12 mb-2">
                    
                    <label for="Clave">Clave</label>
                    <input type="text" class="form-control" id="Clave" name="Clave" value="{{$ultimaNota}}" readonly>
                    @error('Clave')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>


                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    <label for="fecha">Fecha de Alta</label>
                    <input type="text" class="form-control" id="VisualizarFecha" name="VisualizarFecha" readonly>
                    <input type="text" class="form-control" id="FechaCreacion" name="FechaCreacion" readonly hidden>
                    @error('FechaCreacion')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    </svg>
                    <label for="NombreElaborador">Elaboro: </label>
                    <input type="text" class="form-control" id="NombreElaborador" value="{{$user->name}} -- {{$user->cargo}}" name="NombreElaborador" readonly>
                    @error('NombreElaborador')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="row mt-1" id="DatosCliente"> 
                    <script>
                        var Ruta = '{{ route("DetallesCliente") }}';
                    </script>              
                </div>
            </div>

            <div class="row border border-4 rounded mt-2 pb-4">
                <div class="row mt-2">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                        <label for="Tema">Tema</label>
                        <input type="text" id="Tema" name="Tema" class="form-control" value="{{ old('Tema') }}"  readonly> 
                        @error('Tema')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
                        <label for="FechaProximoSeguimiento">Fecha Proximo Seguimiento</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="FechaProximoSeguimiento" value="{{ old('FechaProximoSeguimiento') }}" readonly name="FechaProximoSeguimiento" />
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="datepicker">
                                <i class="bi bi-calendar"></i>
                            </button>
                        </div>
                        @error('FechaProximoSeguimiento')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                    </div>
                </div>
    
                <div class="row">
                    <label for="Observaciones">Observaciones</label>
                    <textarea name="Observaciones" id="Observaciones" class="form-control mx-3" readonly> {{ old('Observaciones') }} </textarea>  
                    @error('Observaciones')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror 
                </div>
            </div>

        


            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="{{route('notas.index')}}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>
                
                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="submit">Agregar nueva nota</button>
                    </div>
                </a>
            </div>

        </form>
    </div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/ModuloClientes/AltaNota.js') }}"></script>
@endsection
