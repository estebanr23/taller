<?php

namespace App\Http\Livewire\Customers;

use App\Models\Area;
use App\Models\Customer;
use Livewire\Component;

class CustomerEdit extends Component
{
    protected $listeners = ['edit'];

    public $showModal = false;
    public $name, $dni, $phone, $file_number, $area_id;
    public $data;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'dni' => 'required|min:7|unique:customers,dni,'.$this->data->id,
            'phone' => 'nullable|min:7',
            'file_number' => 'nullable|unique:customers,file_number,'.$this->data->id,
            'area_id' => 'required',
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'El nombre es requerido',
            'dni.required' => 'El documento es requerido',
            'dni.min' => 'El documento debe tener al menos 7 caracteres',
            'dni.unique' => 'El documento ya existe',
            'phone.min' => 'El telefono debe tener al menos 7 caracteres',
            'file_number.unique' => 'El legajo ya existe',
            'area_id.required' => 'El area es requerida',
        ];
    }

    public function edit(Customer $customer)
    {
        $this->data = $customer;
        $this->name = $customer->name;
        $this->dni = $customer->dni;
        $this->phone = $customer->phone;
        $this->file_number = $customer->file_number;
        $this->area_id = $customer->area_id;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            'name' => $this->name,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'file_number' => $this->file_number,
            'area_id' => $this->area_id,
        ]);

        $this->close();
        $this->emitTo('customers.customer-component', 'notification', ['message' => 'El cliente ha sido actualizado exitosamente']);
        $this->emitTo('customers.customer-component', 'render');

    }

    public function close()
    {
        $this->reset(['name', 'dni', 'phone', 'file_number', 'area_id', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $areas = Area::all();
        return view('livewire.customers.customer-edit', compact('areas'));
    }
}
