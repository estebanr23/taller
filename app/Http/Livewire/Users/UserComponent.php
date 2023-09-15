<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'notification'];
    public int $pages = 10;
    public $search = '';

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
        return view('livewire.users.user-component', [
            'users' => User::withTrashed()->where('name', 'like', '%'.$this->search.'%')->paginate($this->pages)
        ]);
    }
}
