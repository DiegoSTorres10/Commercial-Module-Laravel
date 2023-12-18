<div class="px-3">


    <div class=" text-center">
        <input type="text" id="Busqueda" autocomplete="off" wire:model="search" placeholder="Buscar por Clave, Nombre, Clasificador o Proveedor"
            class=" input-custom mb-3">
    </div>

    <div class="container-fluid mt-2 mb-2 ">
        <span>Mostrar</span>
        
        <select wire:model="cant">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>

        <span> entradas </span>
    
    </div>

    @if ($Productos->count())

        <div class="table-responsive mt-4 mx-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center cursor-pointer" wire:click="order('ClaveProducto')">
                            Clave
                            @if ($sort == 'ClaveProducto')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('Nombre')">
                            Producto
                            @if ($sort == 'Nombre')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('Clasificador')">
                            Clasificador
                            @if ($sort == 'Clasificador')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('Precio')">
                            Precio
                            @if ($sort == 'Precio')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="text-center">
                            Proveedor 
                        </th>

                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Productos as $prod)
                        <tr class="table-active">
                            
                            <td class="text-center"> {{$prod->ClaveProducto}}</td>
                            <td class="text-center" style="max-width: 250px; word-wrap: break-word; overflow: hidden;"> {{$prod->Nombre}} </td>
                            <td class="text-center"> {{$prod->Clasificador}} </td>
                            <td class="text-center"> $ {{number_format($prod->Precio, 0, ',', ',')}}
                                @foreach($prod->proveedores as $proveedor)
                                    @if ($proveedor->pivot->ProveedorSeleccionado == true)
                                        {{$proveedor->pivot->IdTipoMoneda}} 
                                    @endif
                                @endforeach
                            </td>

                            @if($prod->proveedores->count()==0)
                                <td class="text-center"><strong>Sin proveedor asignado</strong></td>
                            @else
                                @foreach($prod->proveedores as $proveedor)
                                    @if ($proveedor->pivot->ProveedorSeleccionado == true)
                                        <td class="text-center">{{$proveedor->NombreComercial}}</td>
                                    
                                    @endif
                                @endforeach
                            @endif
                            
                            
                            <td class="text-center">
                                <div style="display: inline-block;">
                                    <a class="badge rounded mb-2 bg-info" href="{{route('productos.show', $prod)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </div>
                                    <div style="display: inline-block;">
                                        <a class="badge rounded mb-2 bg-success" href="{{route('productos.edit', $prod)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div style="display: inline-block;">
                                        <form action="{{route('productos.destroy', $prod)}}" method="POST" id="form_delete">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="badge rounded bg-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" />
                                                    <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                
                            </td>
                        
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @else
        <div class="text-center ">
            <span class="shadow px-5 py-1" style="max-width: 400px">No existe ningún registro coincidente </span>
        </div>
    @endif
    
    
    @if ($Productos -> links())
        <div class="d-flex justify-content-center mt-4 pb-5">
            {{ $Productos->links() }}
        </div>
    @endif
</div>
