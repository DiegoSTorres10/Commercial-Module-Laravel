<?php

namespace App\Http\Livewire;

use App\Models\Venta;
use Livewire\Component;

use Livewire\WithPagination;

class Ventas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'IdVenta';
    public $direction = 'asc';

    public $cant = 5;

    protected $queryString = [
        'cant' => ['except' => 5],
        'sort' => ['except' => 'IdVenta'],
        'direction' => ['except' => 'asc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $Ventas = Venta::where(function ($query) {
            $query->whereHas('Clientes', function ($subquery) {
                $subquery->where('NombreCompleto', 'like', '%' . $this->search . '%');
            })
                
                ->orWhere('FechaHora', 'like', '%' . $this->search . '%')
                ->orWhereHas('CajaVentas.Almacenes', function ($subquery) {
                    $subquery->where('NombreAlmacen', 'like', '%' . $this->search . '%');
                });
        })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.ventas', compact('Ventas'));
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
