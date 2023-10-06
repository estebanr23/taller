<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ordenes;
use Illuminate\Support\Facades\Auth;


class OrdenesComponent extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'notification'];
    public $search = '';
    public int $pages = 10;
    public $created_order = 'Taller';

    public function notification($notification)
    {
        $this->dispatchBrowserEvent('notification', ['message' => $notification['message']]);
        // $this->dispatchBrowserEvent('notification', ['message' => $notification['message'], 'class' => $notification['class'] ]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function crear()
    {

        return redirect()->to('ordenes/create');
    }

    public function render()
    {

        return view('livewire.ordenes.ordenes-component', [
            'ordenes' => Ordenes::withTrashed()
                                    ->where('id', 'like', '%'.$this->search.'%')
                                    ->where('created_order', $this->created_order)
                                    ->orderBy('date_emission', 'desc')
                                    ->paginate($this->pages),
            'user'=>Auth::user(),
    ]);
    }
}
