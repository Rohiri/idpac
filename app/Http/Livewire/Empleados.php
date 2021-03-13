<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;
use App\Models\Empleado;
use Livewire\WithPagination;

class Empleados extends Component
{
    use WithPagination;

    /**
     * Propiedades Bindeadas
     *
     * @var [type]
     */
    public $nombres, $apellidos, $empresa_id, $email, $telefono, $empleado_id;

    /**
     * Para Controlar el Modal
     *
     * @var integer
     */
    public $isOpen = 0;

    public $search = "";

	protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.empleado.empleados',[
            'empleados' => Empleado::where('nombres',  'ILIKE',"%{$this->search}%")
                ->orWhere('apellidos',  'ILIKE',"%{$this->search}%")
                ->orWhereHas('empresa', function($q){
                    $q->where('nombre',  'ILIKE',"%{$this->search}%");
                })
                ->with('empresa')
                ->paginate(10),
            'empresas' => Empresa::all(),
        ]);
    }

    /**
     * Para Eliminar un empleado
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
    	Empleado::destroy($id);
        session()->flash('message', 'Empleado Eliminado Correctamente');
    }

    /**
     * Funcionalidad para limpiar modal y abrir modal
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * Abrir Modal
     *
     * @return void
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * Cerrar Modal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * Resetear las propiedades
     *
     * @return void
     */
    private function resetInputFields(){
        $this->nombres = '';
        $this->apellidos = '';
        $this->empresa_id = '';
        $this->email='';
        $this->telefono='';
    }

    /**
     * Guardar y Actualizar
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'empresa_id' => 'required',
            'email' => 'required',
            'telefono' => 'required',
        ]);

        Empleado::updateOrCreate(['id' => $this->empresa_id], [
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'empresa_id' => $this->empresa_id,
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        session()->flash('message',
            $this->empresa_id ? 'Empleado Actualizado Correctamente.' : 'Empleado Creado Correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * Bindeamos propiedades para el formulario
     *
     * @var array
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->emmpleado_id = $id;
        $this->nombres = $empleado->nombres;
        $this->apellidos = $empleado->apellidos;
        $this->empresa_id = $empleado->empresa_id;
        $this->telefono = $empleado->telefono;
        $this->openModal();
    }
}
