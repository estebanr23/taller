<?php

namespace App\Http\Livewire\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandTable extends Component
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
        return view('livewire.brands.brand-table', [
            'brands' => Brand::withTrashed()->where('brand_name', 'like', '%'.$this->search.'%')->paginate($this->pages)
        ]);
    }
}
