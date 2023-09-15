<?php

namespace App\Http\Livewire\Models;

use App\Models\ModelDevice;
use Livewire\Component;

class ModelDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(ModelDevice $model)
    {
        $model->delete();

        $this->emitTo('models.model-table', 'notification', ['message' => 'Modelo dado de baja']);
        $this->emitTo('models.model-table', 'render');
    }

    public function restore($modelId)
    {
        ModelDevice::withTrashed()->where('id', $modelId)->first()->restore();

        $this->emitTo('models.model-table', 'notification', ['message' => 'Modelo dado de alta']);
        $this->emitTo('models.model-table', 'render');
    }

    public function render()
    {
        return view('livewire.models.model-delete');
    }
}
