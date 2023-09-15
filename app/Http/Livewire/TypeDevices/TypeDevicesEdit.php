<?php

namespace App\Http\Livewire\TypeDevices;

use App\Models\TypeDevice;
use Livewire\Component;

class TypeDevicesEdit extends Component
{
    public $type_name = '';
    public $type_id = '';
    public $showModal = false;
    public $data;

    protected $listeners = ['edit'];

    protected function rules()
    {
        return [
            'type_name' => ['required', 'string', 'max:255', 'unique:type_devices,type_name,' . $this->type_id],
        ];
    }

    protected function messages() 
    {
        return [
            'type_name.required' => 'El nombre es requerido',
            'type_name.unique' => 'El tipo de dispositivo ya existe',
        ];
    }

    public function edit(TypeDevice $type)
    {
        $this->showModal = true;
        $this->data = $type;

        $this->type_name = $type->type_name;
        $this->type_id = $type->id;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            'type_name' => $this->type_name
        ]);

        $this->close();
        $this->emitTo('type-devices.type-devices-table', 'notification', ['message' => 'El tipo de dispositivo ha sido actualizado exitosamente']);
        $this->emitTo('type-devices.type-devices-table', 'render');

    }

    public function close() {
        $this->reset(['type_name', 'type_id', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.type-devices.type-devices-edit');
    }
}
