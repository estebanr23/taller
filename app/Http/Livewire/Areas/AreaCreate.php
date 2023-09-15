<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use Livewire\Component;

class AreaCreate extends Component
{
    public $showModal = false;
    public $area_name;

    protected $rules = [
        "area_name" => "required|string|unique:areas"
    ];

    public function messages()
    {
        return [
            'area_name.required' => 'El nombre es requerido',
            'area_name.unique' => 'El area ya existe',
        ];
    }

    public function store()
    {
        $this->validate();

        Area::create([
            "area_name" => $this->area_name
        ]);

        $this->close();
        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area registrada exitosamente']);
        $this->emitTo('areas.area-component', 'render');
        
    }

    public function close() 
    {
        $this->reset('area_name', 'showModal');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.areas.area-create');
    }
}
