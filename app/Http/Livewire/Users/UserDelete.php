<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(User $user)
    {
        $user->delete();
        $this->emitTo('users.user-component', 'notification', ['message' => 'Usuario dado de baja']);
        $this->emitTo('users.user-component', 'render');
    }

    public function restore($user)
    {
        $user = User::withTrashed()->where('id', $user)->first()->restore();
        

        $this->emitTo('users.user-component', 'notification', ['message' => 'Usuario dado de alta']);
        $this->emitTo('users.user-component', 'render');
    }

    public function render()
    {
        return view('livewire.users.user-delete');
    }
}
