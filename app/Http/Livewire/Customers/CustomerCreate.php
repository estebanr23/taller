<?php

namespace App\Http\Livewire\Customers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Secretary;
use Livewire\Component;

class CustomerCreate extends Component
{
    public $showModal = false;

    public $name, $lastname, $dni, $phone, $file_number;
    // Secretarias y Areas
    public $secretary_id = '';
    public $area_id = '';
    public $area_name = '';
    public $showNewAreaInput = false;

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'dni' => 'required|min:7|unique:customers,dni',
        'phone' => 'nullable|min:7',
        'file_number' => 'nullable|unique:customers,file_number',
        'area_id' => 'required',
    ];

    protected function messages() 
    {
        return [
            'name.required' => 'El nombre es requerido',
            'lastname.required' => 'El apellido es requerido',
            'dni.required' => 'El documento es requerido',
            'dni.min' => 'El documento debe tener al menos 7 caracteres',
            'dni.unique' => 'El documento ya existe',
            'phone.min' => 'El telefono debe tener al menos 7 caracteres',
            'file_number.unique' => 'El legajo ya existe',
            'area_id.required' => 'El area es requerida',
            'secretary_id.required' => 'La secretaria es requerida',
        ];
    }

    public function store()
    {
        $this->validate();

        Customer::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'file_number' => $this->file_number,
            'secretary_id' => $this->secretary_id,
            'area_id' => $this->area_id,
        ]);

        $this->close();
        $this->emitTo('customers.customer-component', 'notification', ['message' => 'Cliente registrado exitosamente']);
        $this->emitTo('customers.customer-component', 'render');
    }

    public function close()
    {
        $this->reset(['name', 'lastname', 'dni', 'phone', 'file_number', 'area_id', 'secretary_id', 'showModal']);
        $this->resetErrorBag();
    }

    // Areas
    public function toggleNewAreaInput()
    {
        $this->showNewAreaInput = !$this->showNewAreaInput;
    }

    public function storeNewArea()
    {
        
        $validatedData = $this->validate(
            [
                'area_name' => 'required|string|max:255|unique:areas',
                'secretary_id' => 'required',
            ],
            [
                'area_name.required' => 'El nombre es requerido',
                'area_name.unique' => 'El área ya existe',
                'secretary_id.required' => 'La secretaria es requerida',
            ]
        );

        $area = Area::create($validatedData);

        $this->area_id = $area->id;
        $this->showNewAreaInput = false;
        $this->emitTo('customers.customer-component', 'notification', ['message' => 'Area registrada exitosamente']);
    }

    public function render()
    {
        return view('livewire.customers.customer-create', [
            'secretaries' => Secretary::all(),
            'areas' => Area::where('secretary_id', $this->secretary_id)->get(),
        ]);
    }
}
