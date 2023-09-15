<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use Livewire\Component;

class AreaEdit extends Component
{
    protected $listeners = ['edit'];

    public $showModal = false;
    public $area_name;
    public $data;

    public function rules()
    {
        return [
            "area_name" => "required|string|unique:areas,area_name,".$this->data->id
        ];
    }

    public function messages()
    {
        return [
            'area_name.required' => 'El nombre es requerido',
            'area_name.unique' => 'El area ya existe',
        ];
    }

    public function edit(Area $area)
    {
        $this->data = $area;
        $this->area_name = $area->area_name;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            "area_name" => $this->area_name
        ]);

        $this->close();
        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area actualizada exitosamente']);
        $this->emitTo('areas.area-component', 'render');
        
    }

    public function close() 
    {
        $this->reset('area_name', 'showModal');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.areas.area-edit');
    }
}
