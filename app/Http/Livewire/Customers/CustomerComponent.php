<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerComponent extends Component
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
        return view('livewire.customers.customer-component', [
            'customers' => Customer::withTrashed()
                                    ->where('name', 'like', '%'.$this->search.'%')
                                    ->OrWhere('dni', 'like', '%'.$this->search.'%')
                                    ->paginate($this->pages)
        ]);
    }
}
