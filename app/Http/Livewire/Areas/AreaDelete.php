<?php

namespace App\Http\Livewire\Areas;

use App\Models\Area;
use Livewire\Component;

class AreaDelete extends Component
{
    protected $listeners = ['delete', 'restore'];

    public function delete(Area $area)
    {
        $area->delete();

        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area dada de baja']);
        $this->emitTo('areas.area-component', 'render');
    }

    public function restore($id)
    {
        Area::withTrashed()->where('id', $id)->first()->restore();

        $this->emitTo('areas.area-component', 'notification', ['message' => 'Area dada de alta']);
        $this->emitTo('areas.area-component', 'render');
    }

    public function render()
    {
        return view('livewire.areas.area-delete');
    }
}
