<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use App\Models\Secretary;
use Livewire\Component;

class AreaCreate extends Component
{
    public $showModal = false;
    public $area_name, $secretary_id = '';

    protected $rules = [
        "area_name" => "required|string|unique:areas",
        "secretary_id.required" => "La secretaria es requerida",
    ];

    public function messages()
    {
        return [
            'area_name.required' => 'El nombre es requerido',
            'area_name.unique' => 'El area ya existe',
            'secretary_id.required' => 'La secretaria es requerida',
        ];
    }

    public function store()
    {
        $this->validate();

        Area::create([
            "area_name" => $this->area_name,
            "secretary_id" => $this->secretary_id
        ]);

        $this->close();
        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area registrada exitosamente']);
        $this->emitTo('areas.area-component', 'render');
        
    }

    public function close() 
    {
        $this->reset('area_name', 'secretary_id', 'showModal');
        $this->resetErrorBag();
    }

    public function render()
    {
        $secretaries = Secretary::all();
        return view('livewire.areas.area-create', compact('secretaries'));
    }
}
