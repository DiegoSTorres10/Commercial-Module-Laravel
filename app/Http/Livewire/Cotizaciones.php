<?php

namespace App\Http\Livewire;

use App\Models\Cotizacione;
use Livewire\Component;
use Livewire\WithPagination;

class Cotizaciones extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'IdCotizacion';
    public $direction = 'asc';

    public $cant = 5;

    protected $queryString = [
        'cant' => ['except' => 5],
        'sort' => ['except' => 'IdCotizacion'],
        'direction' => ['except' => 'asc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $Cotizaciones = Cotizacione::where(function ($query) {
            $query->whereHas('Clientes', function ($subquery) {
                $subquery->where('NombreCompleto', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('Almacenes', function ($subquery) {
                    $subquery->where('NombreAlmacen', 'like', '%' . $this->search . '%');
                })
                ->orWhere('FechaCotizacion', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.cotizaciones', compact('Cotizaciones'));
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
