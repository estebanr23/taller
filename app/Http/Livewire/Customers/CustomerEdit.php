<?php

namespace App\Http\Livewire\Customers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Secretary;
use Livewire\Component;

class CustomerEdit extends Component
{
    protected $listeners = ['edit'];

    public $showModal = false;
    public $name, $lastname, $dni, $phone, $file_number, $area_id, $secretary_id;
    public $data;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'dni' => 'required|min:7|unique:customers,dni,'.$this->data->id,
            'phone' => 'nullable|min:7',
            'file_number' => 'nullable|unique:customers,file_number,'.$this->data->id,
            'secretary_id' => 'required',
            'area_id' => 'required',
        ];
    }

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
            'secretary_id.required' => 'El area es requerida',
            'area_id.required' => 'El area es requerida',
        ];
    }

    public function edit(Customer $customer)
    {
        $this->data = $customer;
        $this->name = $customer->name;
        $this->lastname = $customer->lastname;
        $this->dni = $customer->dni;
        $this->phone = $customer->phone;
        $this->file_number = $customer->file_number;
        $this->secretary_id = $customer->secretary_id;
        $this->area_id = $customer->area_id;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
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
        $this->reset(['name', 'lastname', 'dni', 'phone', 'file_number', 'area_id', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $secretaries = Secretary::all();
        $areas =  Area::where('secretary_id', $this->secretary_id)->get();
        return view('livewire.customers.customer-edit', compact('areas', 'secretaries'));
    }
}
