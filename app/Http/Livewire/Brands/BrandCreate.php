<?php

namespace App\Http\Livewire\Brands;

use App\Models\Brand;
use Livewire\Component;

class BrandCreate extends Component
{
    public string $brand_name = '';
    public bool $showModal = false;

    protected $rules = [
        'brand_name' => 'required|string|max:255|unique:brands'
    ];

    protected function messages() 
    {
        return [
            'brand_name.required' => 'El nombre es requerido',
            'brand_name.unique' => 'La marca ya existe',
        ];
    }

    public function store()
    {
        $this->validate();

        Brand::create([
            'brand_name' => $this->brand_name
        ]);

        $this->close();
        $this->emitTo('brands.brand-table', 'notification', ['message' => 'Marca registrada exitosamente']);
        $this->emitTo('brands.brand-table', 'render');
    }

    public function close() {
        $this->reset(['brand_name', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.brands.brand-create');
    }
}
