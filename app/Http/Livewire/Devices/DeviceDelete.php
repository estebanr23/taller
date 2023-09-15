<?php

namespace App\Http\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;

class DeviceDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(Device $device)
    {
        $device->delete();

        $this->emitTo('devices.device-table', 'notification', ['message' => 'Dispositivo dado de baja']);
        $this->emitTo('devices.device-table', 'render');
    }

    public function restore($deviceId)
    {
        Device::withTrashed()->where('id', $deviceId)->first()->restore();

        $this->emitTo('devices.device-table', 'notification', ['message' => 'Dispositivo dado de alta']);
        $this->emitTo('devices.device-table', 'render');
    }

    public function render()
    {
        return view('livewire.devices.device-delete');
    }
}
