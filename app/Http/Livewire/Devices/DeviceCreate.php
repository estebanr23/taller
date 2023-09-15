<?php

namespace App\Http\Livewire\Devices;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ModelDevice;
use Livewire\Component;
use App\Models\TypeDevice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class DeviceCreate extends Component
{
    public $serial_number = '';
    public $brand_id = '';
    public $brand_name = '';
    public $type_device_id = '';
    public $type_name = '';
    public $model_id = '';
    public $model_name = '';
    public $showModal = false;
    public $showNewTypeInput = false;
    public $showNewBrandInput = false;
    public $showNewModelInput = false;

    protected $rules = [
        'serial_number' => 'required|string|max:255|unique:devices',
        'brand_id' => 'required',
        'model_id' => 'required',
        'type_device_id' => 'required'
    ];

    protected function messages() 
    {
        return [
            'serial_number.required' => 'El número de serie es requerido',
            'serial_number.unique' => 'El número de serie ya existe',
            'brand_id.required' => 'Debe asociar una marca al dispositivo',
            'brand_id.required' => 'Debe asociar una modelo al dispositivo',
            'type_device_id.required' => 'Debe asociar un tipo al dispositivo'
        ];
    }

    public function store()
    {
        $this->validate();

        Device::create([
            'serial_number' => $this->serial_number,
            'brand_id' => $this->brand_id,
            'model_id' => $this->model_id,
            'type_device_id' => $this->type_device_id
        ]);

        $this->close();
        $this->emitTo('devices.device-table', 'notification', ['message' => 'Dispositivo registrado exitosamente']);
        $this->emitTo('devices.device-table', 'render');
    }

    public function updatingShowModal()
    {
        if (!$this->showModal) {
            $this->close();
        }
    }

    public function generateSerialNumber()
    {
        $this->serial_number = Str::random(10);
    }

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
        $this->emitTo('devices.device-table', 'notification', ['message' => 'Tipo de dispositivo registrado exitosamente']);
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
        $this->emitTo('devices.device-table', 'notification', ['message' => 'Marca registrada exitosamente']);
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
        $this->emitTo('devices.device-table', 'notification', ['message' => 'Modelo registrado exitosamente']);
    }

    public function close() {
        $this->reset(['serial_number', 'brand_id', 'type_device_id', 'model_id', 'showModal', 'showNewTypeInput', 'showNewBrandInput', 'showNewModelInput']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.devices.device-create', [
            'brands' => Brand::all(),
            'types' => TypeDevice::all(),
            'models' => ModelDevice::where('brand_id', $this->brand_id)->get()     
        ]);
    }
}
