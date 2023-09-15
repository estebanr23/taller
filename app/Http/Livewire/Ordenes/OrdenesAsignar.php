<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Ordenes;
use App\Models\User;


class OrdenesAsignar extends Component
{
    protected $listeners = ['asignar', 'notification'];
    public $showModal= false;
    public $tecnico_id='';


    public function asignar(Ordenes $orden)
    {
        $this->data=$orden;
        $this->showModal=true;
    }

    public function update()
    {


            $this->data->update([
                'user_id'=>$this->tecnico_id,
            ]);

        $this->reset(['tecnico_id','showModal']);
        $this->resetErrorBag();
        $this->emitTo('ordenes.ordenes-component', 'notification', ['message' => 'Tecnico asignado']);
    }

    public function close() {
        $this->reset(['tecnico_id','showModal']);
        $this->resetErrorBag();
    }



    public function render()
    {
        return view('livewire.ordenes.ordenes-asignar', ['tecnicos'=>User::all(),]);
    }
}
