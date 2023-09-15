<?php

namespace App\Http\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;

class DeviceTable extends Component
{
    use WithPagination;
    
    public string $search = '';
    public int $pages = 10;
    
    protected $listeners = ['render', 'notification'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function notification($notification)
    {
        $this->dispatchBrowserEvent('notification', ['message' => $notification['message']]);
    }
    
    public function render()
    {
        return view('livewire.devices.device-table', [
            'devices' => Device::withTrashed()->where('serial_number', 'like', '%'.$this->search.'%')->paginate($this->pages)
        ]);
    }
}
