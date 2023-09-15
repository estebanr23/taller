<?php

namespace App\Http\Livewire\Brands;

use App\Models\Brand;
use Livewire\Component;

class BrandEdit extends Component
{
    public $brand_name = '';
    public $brand_id = '';
    public $showModal = false;
    public $data;

    protected $listeners = ['edit', 'notification'];

    protected function rules()
    {
        return [
            'brand_name' => ['required', 'string', 'max:255', 'unique:brands,brand_name,' . $this->brand_id],
        ];
    }

    protected function messages() 
    {
        return [
            'brand_name.required' => 'El nombre es requerido',
            'brand_name.unique' => 'La marca ya existe',
        ];
    }

    public function edit(Brand $brand)
    {
        $this->showModal = true;
        $this->data = $brand;

        $this->brand_name = $brand->brand_name;
        $this->brand_id = $brand->id;
    }

    public function update()
    {
        $this->validate();

        $this->data->update([
            'brand_name' => $this->brand_name,
        ]);

        $this->close();
        $this->emitTo('brands.brand-table', 'notification', ['message' => 'La marca ha sido actualizada exitosamente']);
        $this->emitTo('brands.brand-table', 'render');

    }

    public function close() {
        $this->reset(['brand_name', 'brand_id', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.brands.brand-edit');
    }
}
