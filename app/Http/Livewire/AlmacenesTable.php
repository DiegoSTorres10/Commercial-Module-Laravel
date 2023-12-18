<?php

namespace App\Http\Livewire;

use App\Models\Almacene;
use Livewire\Component;
use Livewire\WithPagination;

class AlmacenesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'IdAlmacen';
    public $direction = 'asc';
    public $cant = 10;

    protected $queryString = [
        'cant' => ['except' => 10],
        'sort' => ['except' => 'IdAlmacen'],
        'direction' => ['except' => 'asc'],
        'search' => ['except' => ''],
    ];
    public function render()
    {
        $Almacenes = Almacene::where('Estatus', 1)
            ->where(function ($query) {
                $query->where('NombreAlmacen', 'like', '%' . $this->search . '%')
                    ->orWhere('Calle', 'like', '%' . $this->search . '%')
                    ->orWhere('Colonia', 'like', '%' . $this->search . '%')
                    ->orWhere('Municipio', 'like', '%' . $this->search . '%')
                    ->orWhere('Estado', 'like', '%' . $this->search . '%')
                    ->orWhereHas('paises', function ($subQuery) {
                        $subQuery->where('Pais', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.almacenes-table', compact('Almacenes'));
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
