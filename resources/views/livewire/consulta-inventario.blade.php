<div class="px-3">

    <h5 class="mt-1"><strong>Datos para filtración</strong></h5>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            <label for="Almacen" class="form-label px-3">Almacen</label>
            <select name="Almacen" id="Almacen" class="form-control text-center" wire:model="Almacen">
                <option value="" selected>--Sin filtro--</option>
                @foreach ($Almacenes as $almacen)
                    <option value="{{ $almacen->IdAlmacen }}">{{ $almacen->NombreAlmacen }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            <label for="Producto" class="form-label px-3">Producto</label>
            <select name="Producto" id="Producto" class="form-control text-center" wire:model="Producto">
                <option value="" selected>--Sin filtro--</option>
                @foreach ($Productos as $producto)
                    <option value="{{ $producto->ClaveProducto }}" >{{ $producto->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            <label for="Clasificador" class="form-label px-3">Clasificador</label>
            <select name="Clasificador" id="Clasificador" class="form-control text-center" wire:model="Clasificador">
                <option value="" selected>--Sin filtro--</option>
                @foreach ($Productos->unique('Clasificador') as $producto)
                    <option value="{{ $producto->Clasificador }}" >{{ $producto->Clasificador  }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            <label for="Tipo" class="form-label px-3">Tipo</label>
            <select name="Tipo" id="Tipo" class="form-control text-center" wire:model="Tipo">
                <option value="" selected>--Sin filtro--</option>
                @foreach ($Tipos as $Tipo)
                    <option value="{{ $Tipo->IdTipo }}">{{ $Tipo->Tipo }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class=" text-center mt-3">
        <input type="text" wire:model="search" placeholder="Buscar por Almacen, Producto, Clave"
            class=" input-custom mb-3" autocomplete="off">
    </div>

    <div class="container-fluid mt-0 mb-2 ">
        <span>Mostrar</span>

        <select wire:model="cant">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>

        <span> entradas </span>

    </div>


    @if ($almacenesConProductos->count())


        <div class="table-responsive mt-4 mx-4">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr class="fondoTabla">
                        <th class="text-center cursor-pointer" wire:click="order('IdAlmacen')">Almacen
                            @if ($sort == 'IdAlmacen')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('productos_servicios.ClaveProducto')">Clave Prod 
                            @if ($sort == 'productos_servicios.Clave')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('productos_servicios.Nombre')">Producto 
                            @if ($sort == 'productos_servicios.Nombre')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="text-center cursor-pointer" wire:click="order('productos_servicios.IdTipo')">Tipo 
                            @if ($sort == 'productos_servicios.IdTipo')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="text-center">Unidad </th>
                        <th class="text-center">Existencias</th>
                        <th class="text-center">Precio</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($almacenesConProductos as  $AlmacenProd)
                        <tr class="table-active">
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $AlmacenProd->NombreAlmacen }} </td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $AlmacenProd->ClaveProducto }} </td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $AlmacenProd->Nombre }} </td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $AlmacenProd->Tipo }}
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $AlmacenProd->UnidadMedida }} </td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ number_format($AlmacenProd->CantidadProductos, 0, ',', ',') }} </td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                $ {{ number_format($AlmacenProd->Precio, 0, ',', ',') }} </td>
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


    @if ($almacenesConProductos->links())
        <div class="d-flex justify-content-center mt-4 pb-5">
            {{ $almacenesConProductos->links() }}
        </div>
    @endif
</div>
