<?php

namespace App\Http\Livewire\Brands;

use App\Models\Brand;
use Livewire\Component;

class BrandDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(Brand $model)
    {
        $model->delete();

        $this->emitTo('brands.brand-table', 'notification', ['message' => 'Marca dado de baja']);
        $this->emitTo('brands.brand-table', 'render');
    }

    public function restore($brandId)
    {
        Brand::withTrashed()->where('id', $brandId)->first()->restore();

        $this->emitTo('brands.brand-table', 'notification', ['message' => 'Marca dado de alta']);
        $this->emitTo('brands.brand-table', 'render');
    }

    public function render()
    {
        return view('livewire.brands.brand-delete');
    }
}
