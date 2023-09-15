<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class AreaComponent extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'notification'];
    public $search = '';
    public int $pages = 10;

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
        return view('livewire.areas.area-component', [
            'areas' => Area::withTrashed()->where('area_name', 'like', '%'.$this->search.'%')->paginate($this->pages)
    ]);
    }
}
