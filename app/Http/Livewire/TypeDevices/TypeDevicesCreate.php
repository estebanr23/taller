<?php

namespace App\Http\Livewire\TypeDevices;

use App\Models\TypeDevice;
use Livewire\Component;

class TypeDevicesCreate extends Component
{
    public string $type_name = '';

    public $showModal = false;

    protected $rules = [
        'type_name' => 'required|string|max:255|unique:type_devices'
    ];

    protected function messages() 
    {
        return [
            'type_name.required' => 'El nombre es requerido',
            'type_name.unique' => 'El tipo de dispositivo ya existe'
        ];
    }

    public function store()
    {
        $this->validate();

        TypeDevice::create([
            'type_name' => $this->type_name
        ]);

        $this->close();
        $this->emitTo('type-devices.type-devices-table', 'notification', ['message' => 'Tipo de dispositivo registrado exitosamente']);
        $this->emitTo('type-devices.type-devices-table', 'render');
    }

    public function close() {
        $this->reset(['type_name', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.type-devices.type-devices-create');
    }
}
