<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEdit extends Component
{
    protected $listeners = ['edit'];

    public $name;
    public $username;
    public $password;
    public $dni;
    public $role = '';
    public $showModal = false;

    public $data;

    protected function rules()
    {
        return [
        'name' => 'required|string',
        'username' => 'required|string|unique:users,username,'.$this->data->id,
        'password' => 'nullable|min:8',
        'dni' => 'required|min:7',
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'El nombre es requerido',
            'username.required' => 'El usuario es requerido',
            'username.unique' => 'El usuario ya existe',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'dni.required' => 'El documento es requerido',
            'dni.min' => 'El documento no es valido',
        ];
    }

    public function edit(User $user)
    {
        $this->showModal = true;
        $this->data = $user;

        $this->name = $user->name;
        $this->username = $user->username;
        $this->dni = $user->dni;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate();
        
        $this->data->update([
            'name' => $this->name,
            'username' => $this->username,
            'dni' => $this->dni,
            'role' => $this->role
            // 'password' => Hash::make($this->password) ,
        ]);

        $this->close();
        $this->emitTo('users.user-component', 'notification', ['message' => 'El usuario ha sido actualizado exitosamente']);
        $this->emitTo('users.user-component', 'render');

    }

    public function close() {
        $this->reset(['name', 'username', 'dni', 'password', 'role', 'showModal']);
        $this->resetErrorBag();
    } 

    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
