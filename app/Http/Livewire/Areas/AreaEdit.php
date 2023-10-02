<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use App\Models\Secretary;
use Livewire\Component;

class AreaEdit extends Component
{
    protected $listeners = ['edit'];

    public $showModal = false;
    public $area_name, $secretary_id;
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
        $this->secretary_id = $area->secretary_id;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            "area_name" => $this->area_name,
            "secretary_id" => $this->secretary_id
        ]);

        $this->close();
        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area actualizada exitosamente']);
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
        return view('livewire.areas.area-edit', compact('secretaries'));
    }
}
