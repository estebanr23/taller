<?php

namespace App\Http\Livewire\TypeDevices;

use App\Models\TypeDevice;
use Livewire\Component;
use Livewire\WithPagination;

class TypeDevicesTable extends Component
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
        return view('livewire.type-devices.type-devices-table', [
            'typeDevices' => TypeDevice::where('type_name', 'like', '%'.$this->search.'%')->paginate($this->pages)
        ]);
    }
}
