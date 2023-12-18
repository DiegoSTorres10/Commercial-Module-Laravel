<?php

namespace App\Http\Livewire;

use App\Models\Proveedore;
use Livewire\Component;
use Livewire\WithPagination;

class ProveedoresTabla extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort='IdProveedor';
    public $direction = 'desc';

    public $cant = 10;

    protected $queryString = [
        'cant' => ['except' => 10],
        'sort' => ['except' => 'IdProveedor'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $Proveedores = Proveedore::where('NombreComercial','like', '%'.$this->search.'%')
                                ->orwhere('GrupoEmpresarial','like', '%'.$this->search.'%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->cant);
        return view('livewire.proveedores-tabla', compact('Proveedores'));
    }

    public function order ($sort){
        if ($this->sort == $sort){
            if($this->direction == 'desc')
                $this->direction = 'asc';
            else
                $this->direction = 'desc';
        }
        else
            $this->sort = $sort;
    }
}
