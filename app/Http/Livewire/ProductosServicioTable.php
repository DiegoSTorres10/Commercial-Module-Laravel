<?php

namespace App\Http\Livewire;

use App\Models\ProductosServicio;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosServicioTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'ClaveProducto';
    public $direction = 'desc';
    public $cant = 10;

    protected $queryString = [
        'cant' => ['except' => 10],
        'sort' => ['except' => 'ClaveProducto'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function render()
    {
        $Productos = ProductosServicio::where('Estatus', 1)
            ->where(function ($query) {
                $query->where('ClaveProducto', 'like', '%' . $this->search . '%')
                    ->orWhere('Nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('Clasificador', 'like', '%' . $this->search . '%')
                    ->orWhereHas('proveedores', function ($subQuery) {
                        $subQuery->where('NombreComercial', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.productos-servicio-table', compact('Productos'));
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
