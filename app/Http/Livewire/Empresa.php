<?php

namespace App\Http\Livewire;

use Faker\Factory;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa as Bussiness;

class Empresa extends Component
{
    use WithPagination;

    /**
     * Variables Asociadas del modelo
     *
     * @var [type]
     */
    public $nombre, $email, $website, $empresa_id;

    /**
     * Para Controlar el Modal
     *
     * @var integer
     */
    public $isOpen = 0;

    /**
     * Para Busqueda en la tabla
     *
     * @var string
     */
    public $search = "";

	//protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.empresa.empresa',[
            'empresas' =>Bussiness::where('nombre',  'ILIKE',"%{$this->search}%")
                ->orWhere('email',  'ILIKE',"%{$this->search}%")
                ->orWhere('website',  'ILIKE',"%{$this->search}%")
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }

    /**
     * Para Eliminar una empresa
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
    	Bussiness::destroy($id);
        session()->flash('message', 'Empresa Eliminada Correctamente');
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
        $this->nombre = '';
        $this->email = '';
        $this->website='';
    }

    /**
     * Guardar y Actualizar
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        $faker = Factory::create();

        Bussiness::updateOrCreate(['id' => $this->empresa_id], [
            'nombre' => $this->nombre,
            'email' => $this->email,
            'logo'  => $faker->imageUrl($width = 128, $height = 128),
            'website' => $this->website,
        ]);

        session()->flash('message',
            $this->empresa_id ? 'Empresa Actualizada Correctamente.' : 'Empresa Creada Correctamente.');

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
        $empresa = Bussiness::findOrFail($id);
        $this->empresa_id = $id;
        $this->nombre = $empresa->nombre;
        $this->email = $empresa->email;
        $this->website = $empresa->website;
        $this->openModal();
    }
}
