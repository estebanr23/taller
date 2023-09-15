<?php

namespace App\Http\Livewire\Models;

use App\Models\Brand;
use Livewire\Component;
use App\Models\ModelDevice;

class ModelCreate extends Component
{
    public $model_name = '';
    public $brand_id = '';
    public $brand_name = '';
    public $showNewBrandInput = false;
    public $showModal = false;

    protected $rules = [
        'model_name' => 'required|string|max:255|unique:models',
        'brand_id' => 'required'
    ];

    protected function messages() 
    {
        return [
            'model_name.required' => 'El nombre es requerido',
            'model_name.unique' => 'El modelo ya existe',
            'brand_id' => 'Debes asociar una marca al modelo'
        ];
    }

    public function store()
    {
        $this->validate();

        ModelDevice::create([
            'model_name' => $this->model_name,
            'brand_id' => $this->brand_id
        ]);

        $this->close();
        $this->emitTo('models.model-table', 'notification', ['message' => 'Modelo registrado exitosamente']);
        $this->emitTo('models.model-table', 'render');
    }

    // Brand
    public function toggleNewBrandInput()
    {
        $this->showNewBrandInput = !$this->showNewBrandInput;
        $this->brand_name = '';
        $this->resetErrorBag();
    }

    public function storeNewBrand()
    {
        $validatedData = $this->validate(
            [
                'brand_name' => 'required|string|max:255|unique:brands'
            ],
            [
                'brand_name.required' => 'El nombre es requerido',
                'brand_name.unique' => 'La marca ya existe'
            ]
        );

        $brand = Brand::create($validatedData);

        $this->brand_id = $brand->id;
        $this->showNewBrandInput = false;
        $this->emitTo('models.model-table', 'notification', ['message' => 'Marca registrada exitosamente']);
        $this->resetErrorBag();
    }

    public function close() {
        $this->reset(['model_name', 'brand_id', 'brand_name', 'showModal', 'showNewBrandInput']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.models.model-create', [
            'brands' => Brand::all()
        ]);
    }
}
