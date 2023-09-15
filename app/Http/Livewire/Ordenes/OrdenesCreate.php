<?php

namespace App\Http\Livewire\Ordenes;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Brand;
use App\Models\State;
use App\Models\Ordenes;
use App\Models\Tickets;
use Livewire\Component;
use App\Models\Customer;
use App\Models\TypeDevice;
use App\Models\ModelDevice;
use App\Models\Device;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrdenesCreate extends Component
{
    protected $listeners = ['render', 'notification'];

    public $ClienteForm=true;
    public $EquipoForm=false;
    public $TecnicoForm=false;
    public $DatosCliente=false;
    public $nombre_cliente,$telefono,$DNI,$legajo,$falla,$informe_cliente,$informe_tecnico,$fecha_emision,$fecha_entrega,$persona,$ticket;
    public $type_device_id='';
    public $brand_id='';
    public $tecnico_id='';
    public $receptor='';
    public $model_id = '';
    public $model_name = '';
    public $orden='';
    public $estado='';
    public $tipo_orden=false;
    // Areas
    public $area_id = '';
    public $area_name = '';
    public $showNewAreaInput = false;
    //Equipos//
    //tipos
    public $type_name = '';
    public $showNewTypeInput = false;
    //Marca
    public $brand_name='';
    public $showNewBrandInput = false;
    //Modelo
    public $showNewModelInput = false;
    //Numero de serie
    public $serial_number='';
    public $device;


    protected $rulesCliente = [
        'nombre_cliente' => 'required|string',
        'DNI' => 'required|min:7',
        'telefono' => 'nullable|min:7',
        'legajo' => 'nullable',
        'area_id' => 'required',
    ];

    protected $rulesEquipo = [
        'brand_id' => 'required',
        'model_id' => 'required',
        'type_device_id' => 'required',
        'falla'=>'required',
        'informe_cliente'=>'required'
    ];

    protected $rulesTecnico = [
        'fecha_emision'=>'required',
        'orden'=>'required',
        'ticket'=>'required|unique:tickets,description',
        'receptor'=>'required',
        'orden'=>'required',
        'estado'=>'required',
    ];

    public function mount() {
        $this->fecha_emision = Carbon::now()->toDateString();
        $this->receptor = Auth::user()->id;
    }

    protected function messages()
    {
        return [
            'falla.required'=>'Indique una falla o arreglo',
            'brand_id.required' => 'Debe asociar una marca al dispositivo',
            'model_id.required' => 'Debe asociar una modelo al dispositivo',
            'type_device_id.required' => 'Debe asociar un tipo al dispositivo',
            'nombre_cliente.required' => 'El nombre es requerido',
            'DNI.required' => 'El documento es requerido',
            'DNI.min' => 'El documento debe tener al menos 7 caracteres',
            'telefono.min' => 'El telefono debe tener al menos 7 caracteres',
            'area_id.required' => 'El area es requerida',
            'fecha_emision'=>'Fecha en la que se crea la orden requerido',
            'orden.required'=>'Tipo de orden requerido',
            'ticket.required'=>'Tiene que generar un numero de ticket',
            'ticket.unique'=>'El ticket no se puede repetir',
            'receptor.required'=>'Debe marcar quien recibe el equipo',
            'estado.required'=>'Estado de la orden requerido',
            'informe_cliente.required'=>'Se necesita poner una descripcion'
        ];
    }

    public function ShowCliente()
    {
        // $this->validate($this->rulesEquipo);
        $this->ClienteForm = true;
        $this->EquipoForm=false;

    }
    public function ShowEquipo()
    {
        $this->validate($this->rulesCliente);
        $this->ClienteForm = false;
        $this->EquipoForm=true;
        $this->TecnicoForm=false;


    }
    public function ShowTecnico()
    {
        $this->validate($this->rulesEquipo);
        $this->EquipoForm=false;
        $this->TecnicoForm=true;
    }

    public function buscar()
    {
        $this->nombre_cliente = '';
        $this->telefono = '';
        $this->legajo = '';
        $this->area_id = '';

        $this->persona=Customer::where('dni',$this->DNI)->first();
        if($this->persona)
        {

            $this->nombre_cliente=$this->persona->name;
            $this->DNI=$this->persona->dni;
            $this->telefono=$this->persona->phone;
            $this->legajo=$this->persona->file_number;
            $this->area_id=$this->persona->area_id;


        }
        $this->DatosCliente=true;
    }

    public function Buscar_Serial()
    {

        $this->device=Device::where('serial_number',$this->serial_number)->first();
        if($this->device)
        {
            $this->type_device_id=$this->device->typeDevice;
            $this->brand_id=$this->device->brand_id;
            $this->model_id=$this->device->model_id;
        }
        else
        {
            if($this->serial_number=='')
            {
                $this->serial_number=Str::random(10);
            }
            $this->type_device_id='';
            $this->brand_id='';
            $this->model_id='' ;
        }



    }


    public function Guardar()
    {

        $this->ticket = Str::random(10);

        $this->validate($this->rulesTecnico);

        if($this->tecnico_id=='')
        {
            $this->tecnico_id=null;
        }

        if(!$this->device)
        {
            $this->device=Device::create([
                'serial_number'=>$this->serial_number,
                'type_device_id'=> $this->type_device_id,
                'brand_id'=>$this->brand_id,
                'model_id'=>$this->model_id
            ]);
        }

        //Crea la orden y la persona dependiendo si existe o no
        if($this->persona)
        {
            //Crea el ticket y lo guarda
            $ticket =Tickets::create(['description'=>$this->ticket,'customer_id'=>$this->persona->id]);
            $order = Ordenes::create([
                'device_id'=>$this->device->id,
                'customer_id'=>$this->persona->id,
                'receiver_user'=>$this->receptor,
                'user_id'=>$this->tecnico_id,
                'problem'=>$this->falla,
                'report_customer'=>$this->informe_cliente,
                'report_technical'=>$this->informe_tecnico,
                'date_emission'=>$this->fecha_emision,
                'date_delivery'=>$this->fecha_entrega,
                'state_id'=>$this->estado,
                'type_order'=>$this->orden,
                'remote_repair'=>$this->tipo_orden,
                'ticket_id'=>$ticket->id,

            ]);
        }
        else
        {
            $nueva_persona=Customer::create([
                'name' =>  $this->nombre_cliente,
                'dni' =>  $this->DNI,
                'phone' => $this->telefono,
                'file_number' => $this->legajo,
                'area_id' =>  $this->area_id,
            ]);

            $ticket =Tickets::create(['description'=>$this->ticket,'customer_id'=>$nueva_persona->id]);
            $order = Ordenes::create([
                'device_id'=>$this->type_device_id,
                'customer_id'=>$nueva_persona->id,
                'receiver_user'=>$this->receptor,
                'user_id'=>$this->tecnico_id,
                'problem'=>$this->falla,
                'report_customer'=>$this->informe_cliente,
                'report_technical'=>$this->informe_tecnico,
                'date_emission'=>$this->fecha_emision,
                'date_delivery'=>$this->fecha_entrega,
                'state_id'=>$this->estado,
                'type_order'=>$this->orden,
                'remote_repair'=>$this->tipo_orden,
                'ticket_id'=>$ticket->id,

            ]);
        }

        $this->emitTo('ordenes.ordenes-component', 'notification', ['message' => 'Orden actualizada exitosamente']);
        redirect()->route('ordenes.index');
        return $this->exportPDF($order);
    }

    // Areas
    public function toggleNewAreaInput()
    {
        $this->showNewAreaInput = !$this->showNewAreaInput;
    }

    public function storeNewArea()
    {
        $validatedData = $this->validate(
            [
                'area_name' => 'required|string|max:255|unique:areas'
            ],
            [
                'area_name.required' => 'El nombre es requerido',
                'area_name.unique' => 'El área ya existe'
            ]
        );

        $area = Area::create($validatedData);

        $this->area_id = $area->id;
        $this->showNewAreaInput = false;
        $this->emitTo('ordenes.ordenes-create', 'notification', ['message' => 'Area registrada exitosamente']);
    }

    //Nuevos Equipos

    // Type Devices
    public function toggleNewTypeInput()
    {
        $this->showNewTypeInput = !$this->showNewTypeInput;
    }

    public function storeNewType()
    {
        $validatedData = $this->validate(
            [
                'type_name' => 'required|string|max:255|unique:type_devices'
            ],
            [
                'type_name.required' => 'El nombre es requerido',
                'type_name.unique' => 'El tipo de dispositivo ya existe'
            ]
        );

        $type = TypeDevice::create($validatedData);

        $this->type_device_id = $type->id;
        $this->showNewTypeInput = false;
        $this->emitTo('ordenes.ordenes-create', 'notification', ['message' => 'Tipo de dispositivo registrado exitosamente']);
    }

    // Brands
    public function toggleNewBrandInput()
    {
        $this->showNewBrandInput = !$this->showNewBrandInput;
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
        $this->emitTo('ordenes.ordenes-create', 'notification', ['message' => 'Marca registrada exitosamente']);
    }

    // Models
    public function toggleNewModelInput()
    {
        $this->showNewModelInput = !$this->showNewModelInput;
    }

    public function storeNewModel()
    {
        $validatedData = $this->validate(
            [
                'model_name' => 'required|string|max:255|unique:models',
                'brand_id' => 'required'
            ],
            [
                'model_name.required' => 'El nombre es requerido',
                'model_name.unique' => 'La marca ya existe',
                'brand_id' => 'Debes asociar una marca al modelo'
            ]
        );

        $model = ModelDevice::create($validatedData);

        $this->model_id = $model->id;
        $this->showNewModelInput = false;
        $this->emitTo('ordenes.ordenes-create', 'notification', ['message' => 'Modelo registrado exitosamente']);
    }

    // Export PDF
    public function exportPDF(Ordenes $order) {
        $pdf = Pdf::loadView('reports.order-create', ['order' => $order])->output();
        return response()->streamDownload(fn() => print($pdf), 'export.pdf');
    }

    public function notification($notification)
    {
        $this->dispatchBrowserEvent('notification', ['message' => $notification['message']]);
    }

    public function render()
    {
        return view('livewire.ordenes.ordenes-create', [
            'brands' => Brand::all(),
            'types' => TypeDevice::all(),
            'tecnicos'=>User::all(),
            'areas' => Area::all(),
            'estados'=>State::all(),
            'user'=>Auth::user(),
            'models' => ModelDevice::where('brand_id', $this->brand_id)->get()
        ]);
    }

}
