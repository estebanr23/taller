<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class CustomerDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(Customer $customer)
    {
        $customer->delete();

        $this->emitTo('customers.customer-component', 'notification', ['message' => 'Cliente dado de baja']);
        $this->emitTo('customers.customer-component', 'render');
    }

    public function restore($customer)
    {
        $customer = Customer::withTrashed()->where('id', $customer)->first()->restore();

        $this->emitTo('customers.customer-component', 'notification', ['message' => 'Cliente dado de alta']);
        $this->emitTo('customers.customer-component', 'render');
    }

    public function render()
    {
        return view('livewire.customers.customer-delete');
    }
}
