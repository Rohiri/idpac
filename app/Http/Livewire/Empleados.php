<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empleado;

class Empleados extends Component
{
    use WithPagination;

    public $search = "";

	protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.empleados',[
            'empleados' => Empleado::where('nombres',  'ILIKE',"%{$this->search}%")
                ->orWhere('apellidos',  'ILIKE',"%{$this->search}%")
                ->orWhereHas('empresa', function($q){
                    $q->where('nombre',  'ILIKE',"%{$this->search}%");
                })
                ->with('empresa')
                ->paginate(10)
        ]);
    }
}
