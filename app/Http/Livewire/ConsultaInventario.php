<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Almacene;
use App\Models\ProductosServicio;
use App\Models\TipoProdServicio;
use Livewire\WithPagination;

class ConsultaInventario extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'NombreAlmacen';
    public $direction = 'asc';
    public $cant = 5;
    public $Almacen = '';
    public $Producto = '';
    public $Clasificador = '';
    public $Tipo = '';


    protected $queryString = [
        'cant' => ['except' => 5],
        'sort' => ['except' => 'NombreAlmacen'],
        'direction' => ['except' => 'asc'],
        'search' => ['except' => ''],
        'Almacen' => ['except' => ''],
        'Producto'  => ['except' => ''],
        'Clasificador'  => ['except' => ''],
        'Tipo'  => ['except' => ''],

    ];
    public function render()
    {

        $Tipos = TipoProdServicio::all();
        $Productos = ProductosServicio::where('Estatus',1)->orderBy('Nombre', 'asc')->get();
        $Almacenes = Almacene::where('Estatus',1)->orderBy('NombreAlmacen', 'asc')->get();
        $almacenesConProductos = Almacene::join('almacenes_productos', 'almacenes.IdAlmacen', '=', 'almacenes_productos.IdAlmacen')
            ->join('productos_servicios', 'almacenes_productos.ClaveProducto', '=', 'productos_servicios.ClaveProducto')
            ->join('tipo_prod_servicios', 'tipo_prod_servicios.IdTipo', '=', 'productos_servicios.IdTipo')
            ->where(function ($query) {
                $query->where('almacenes.NombreAlmacen', 'like', '%' . $this->search . '%')
                    ->orWhere('productos_servicios.Nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('productos_servicios.ClaveProducto', 'like', '%' . $this->search . '%');
            })
            ->when($this->Almacen, function ($query) {
                $query->where('almacenes.IdAlmacen', $this->Almacen);
            })
            ->when($this->Producto, function ($query) {
                $query->where('productos_servicios.ClaveProducto', $this->Producto);
            })
            ->when($this->Clasificador, function ($query) {
                $query->where('productos_servicios.Clasificador', $this->Clasificador);
            })
            ->when($this->Tipo, function ($query) {
                $query->where('tipo_prod_servicios.IdTipo', $this->Tipo);
            })
            ->select('almacenes.*', 'productos_servicios.*', 'almacenes_productos.CantidadProductos', 'tipo_prod_servicios.*')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.consulta-inventario', compact('Tipos', 'Almacenes', 'Productos', 'almacenesConProductos'));
    }

    public function updatingAlmacen()
    {
        $this->resetPage();
    }

    public function updatingProducto()
    {
        $this->resetPage();
    }

    public function updatingClasificador()
    {
        $this->resetPage();
    }

    public function updatingTipo()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc')
                $this->direction = 'asc';
            else
                $this->direction = 'desc';
        } else
            $this->sort = $sort;
    }
}
