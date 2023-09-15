<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $username;
    public $password;
    public $dni;
    public $role = '';

    public $showModal = false;

    protected $rules = [
        'name' => 'required|string',
        'username' => 'required|string|unique:users',
        'password' => 'required|min:8',
        'dni' => 'required|min:7|unique:customers,dni',
    ];

    protected function messages() 
    {
        return [
            'name.required' => 'El nombre es requerido',
            'username.required' => 'El usuario es requerido',
            'username.unique' => 'El usuario ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'dni.required' => 'El documento es requerido',
            'dni.min' => 'El documento no es valido',
            'dni.unique' => 'El documento ya existe',
        ];
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'dni' => $this->dni,
            'password' => Hash::make($this->password),
            'role' => $this->role
        ]);

        // $this->reset(['name', 'username', 'dni', 'password', 'rol']);
        // $this->resetErrorBag();
        // session()->flash('status', __('Usuario creado'));
        $this->close();
        $this->emitTo('users.user-component', 'notification', ['message' => 'Usuario registrado exitosamente']);
        $this->emitTo('users.user-component', 'render');
    }

    public function close() {
        $this->reset(['name', 'username', 'dni', 'password', 'role', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }
}
