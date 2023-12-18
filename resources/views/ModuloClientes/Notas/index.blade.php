@extends('layaout.plantilla')

@section('titulo', 'Seguimiento Notas')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">

@endsection

@section('subtitulo', 'Seguimiento de notas')

@section('contenido')

    <div class="container-fluid">

        @if(session()->has('update_nota'))
            <div class="alert alert-primary">
                {!! session()->get('update_nota') !!}
            </div>
        @elseif (session()->has('create_nota'))
            <div class="alert alert-success">
                {!! session()->get('create_nota') !!}
            </div>
        @elseif (session()->has('delete_nota'))
            <div class="alert alert-secondary">
                {{ session('delete_nota') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif

        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <a href="{{ route('notas.create') }}" class="botones boton-izquierda">
                    <i class='bx bx-comment-add'></i>
                    <span>Nueva Nota</span>
                </a>
                <button class="botones boton-derecha" id="BotonCalendar">
                    <i class='bx bxs-calendar'></i>
                    <span>Ver en Calendario</span>
                </button>
            </div>
        </div>

        <div class="table-responsive mt-4 mx-4">
            <table class="table table-striped table-hover  ">
                <thead>
                    <tr>
                        <th class="text-center">Cliente</th>
                        <th class="text-center" style="width: 450px;">Título Nota </th>
                        <th class="text-center">Fecha creación </th>
                        <th class="text-center">Fecha revisión </th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Notas as $not)
                        <tr class="table-active">
                            
                            <td class="text-center"> {{$not->clientes->NombreCompleto}}</td>
                            <td class="text-center"> {{$not->Tema}} </td>
                            <td class="text-center"> {{$not->FechaCreacion}}</td>
                            <td class="text-center"> {{$not->FechaProximoSeguimiento}}</td>
                            <td class="text-center"> 
                                @if ($not->Estatus == 1)
                                    <span class="text-success"><strong>Activa</strong></span>
                                @else
                                    <span class="text-primary"><strong>Finalizada</strong></span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div style="display: inline-block;">
                                    <a class="badge rounded mb-2 bg-info" href="{{route('notas.show', $not)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </div>
                                @if ($not->Estatus == 1)
                                    <div style="display: inline-block;">
                                        <a class="badge rounded mb-2 bg-success" href="{{route('notas.edit', $not)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <div style="display: inline-block;">
                                        <form action="{{ route('notas.destroy', $not) }}" method="POST" id="form_delete">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="badge rounded bg-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" />
                                                    <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                
                            </td>
                        
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $Notas->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $Notas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $Notas->lastPage(); $i++)
                        <li class="page-item {{ $Notas->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $Notas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $Notas->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $Notas->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="calendar container pb-5 mt-2" id="calendar"></div>
    

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var boton = document.getElementById("BotonCalendar");
            boton.addEventListener("click", function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    height: 710,
                    locale: 'es-es',
                    todayColor: '#0000ff',
                    initialView: 'dayGridMonth',
                    events: @json($events),
                    eventContent: function(arg) {
                        return {
                            html: arg.event.title + '<br>' + arg.event.extendedProps.description
                        };
                    },
                    
                });
                calendar.render();
                calendarEl.scrollIntoView({ behavior: 'smooth' });
            });
            
        });

    </script>
@endsection
