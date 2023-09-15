<?php

namespace App\Http\Livewire\Models;

use App\Models\ModelDevice;
use Livewire\Component;
use Livewire\WithPagination;

class ModelTable extends Component
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
        return view('livewire.models.model-table', [
            'models' => ModelDevice::withTrashed()->where('model_name', 'like', '%'.$this->search.'%')->paginate($this->pages)
        ]);
    }
}
