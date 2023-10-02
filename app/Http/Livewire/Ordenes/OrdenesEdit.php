<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use App\Models\Brand;
use App\Models\TypeDevice;
use App\Models\ModelDevice;
use App\Models\Ordenes;
use App\Models\Device;

class OrdenesEdit extends Component
{

    protected $listeners = ['editar', 'notification'];

    public $showModal= false;

    public $falla,$accesorios,$informe_cliente,$informe_tecnico,$data;
    public $type_device_id='';
    public $brand_id='';
    public $model_id = '';
    public $model_name = '';

    public function editar(Ordenes $orden)
    {
        $this->data=$orden;
        $equipo=Device::where('id',$orden->device_id)->first();
        $this->showModal = true;
        $this->type_device_id=$orden->device_id;
        $this->brand_id=$equipo->brand_id;
        $this->model_id=$equipo->model_id;
        $this->falla=$orden->problem;
        $this->accesorios=$orden->accessories;
        $this->informe_cliente=$orden->report_customer;
        $this->informe_tecnico=$orden->report_technical;
    }


    protected $rulesEquipo = [
        'brand_id' => 'required',
        'model_id' => 'required',
        'type_device_id' => 'required',
        'falla'=>'required',
        'informe_cliente'=>'required'
    ];

    protected function messages()
    {
        return [
            'brand_id.required' => 'Debe asociar una marca al dispositivo',
            'model_id.required' => 'Debe asociar una modelo al dispositivo',
            'type_device_id.required' => 'Debe asociar un tipo al dispositivo',
            'falla.required'=>'Indique una falla o arreglo',
            'informe_cliente.required'=>'Se necesita poner una descripcion'
        ];
    }

    public function update()
    {
            $this->validate($this->rulesEquipo);


            $this->data->update([
                'device_id'=>$this->type_device_id,
                'problem'=>$this->falla,
                'accessories'=>$this->accesorios,
                'report_customer'=>$this->informe_cliente,
                'report_technical'=>$this->informe_tecnico,
            ]);

        $this->reset(['type_device_id', 'falla', 'accesorios', 'informe_cliente', 'informe_tecnico', 'showModal']);
        $this->resetErrorBag();
        $this->emitTo('ordenes.ordenes-component', 'notification', ['message' => 'Orden editada exitosamente']);
    }


    public function close() {
        $this->reset(['type_device_id', 'falla', 'accesorios', 'informe_cliente', 'informe_tecnico', 'showModal']);
        $this->resetErrorBag();
    }



    public function render()
    {
        return view('livewire.ordenes.ordenes-edit', [
            'brands' => Brand::all(),
            'types' => TypeDevice::all(),
            'models' => ModelDevice::where('brand_id', $this->brand_id)->get()
        ]);
    }
}
