<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteTabla extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'IdCliente';
    public $direction = 'desc';

    public $cant = 10;

    protected $queryString = [
        'cant' => ['except' => 10],
        'sort' => ['except' => 'IdCliente'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $clientes = Cliente::where(function ($query) {
            $query->where('Estatus', 1)
                ->where(function ($subQuery) {
                    $subQuery->where('RFC', 'like', '%' . $this->search . '%')
                        ->orWhere('NombreCompleto', 'like', '%' . $this->search . '%');
                });
        })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.cliente-tabla', compact('clientes'));
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
