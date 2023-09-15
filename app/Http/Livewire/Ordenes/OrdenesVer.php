<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use App\Models\User;
use App\Models\Ordenes;
use App\Models\Tickets;



class OrdenesVer extends Component
{
    protected $listeners = ['ver', 'notification'];

    public $showModal= false;
    public $nombre_cliente,$telefono,$DNI,$area_nombre,$legajo,$falla,$informe_cliente,$informe_tecnico,$fecha_emision,$fecha_entrega,$ticket,$marca,$tipo,$modelo,$tecnico,$tipo_orden;
    public $receptor='';
    public $orden='';
    public $estado='';
    public $consulta;

    public function ver(Ordenes $orden)
    {

        $this->showModal = true;
        $tecnico_receptor=User::where('id',$orden->receiver_user)->first();
        $descripcion=Tickets::where('id',$orden->ticket_id)->first();

        $this->DNI=$orden->Customer->dni;
        $this->nombre_cliente=$orden->Customer->name;
        $this->telefono=$orden->Customer->phone;
        $this->area_nombre=$orden->Customer->area->area_name;
        $this->legajo=$orden->Customer->file_number;
        $this->tipo=$orden->Device->typeDevice->type_name;
        $this->marca=$orden->Device->brand->brand_name;
        $this->modelo=$orden->Device->model->model_name;
        $this->informe_cliente=$orden->report_customer;
        $this->informe_tecnico=$orden->report_technical;
        $this->falla=$orden->problem;
        $this->receptor=$tecnico_receptor->name;
        // $date = date_create($orden->date_emission);
        $this->fecha_emision=$orden->date_emission;
        // $date = date_create($orden->date_delivery);
        $this->fecha_entrega=$orden->date_delivery;
        $this->estado=$orden->State->name;
        $this->ticket=$descripcion->description;
        $this->tipo_orden=$orden->type_order;

        if($orden->remote_repair==0)
        {
            $this->consulta=false;
        }
        else{
            $this->consulta=$orden->remote_repair;
        }

        if($orden->user_id)
        {
            $this->tecnico=$orden->User->name;
        }
    }


    public function close() {
        $this->reset(['DNI','consulta','nombre_cliente','telefono','area_nombre','legajo','tipo','marca','modelo','informe_cliente','informe_tecnico','falla','receptor','fecha_emision','fecha_entrega','estado','ticket','tecnico', 'showModal']);
        $this->resetErrorBag();
    }



    public function render()
    {
        return view('livewire.ordenes.ordenes-ver');

    }
}
