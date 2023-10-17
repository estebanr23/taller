<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use App\Models\State;
use App\Models\Ordenes;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrdenesFinalizar extends Component
{
    protected $listeners = ['finalizar', 'notification', 'exportOrdenEntrega'];
    public $showModal= false;
    public $estado,$informe_tecnico,$falla, $data;


    public function finalizar(Ordenes $orden)
    {
        $this->data=$orden;
        $this->showModal=true;
        $this->estado=$orden->state_id;
        $this->informe_tecnico=$orden->report_technical;
        $this->falla=$orden->problem;
    }

    protected $rulesFinalizar = [
        'falla'=>'required',
    ];

    protected function messages()
    {
        return [
            'falla.required'=>'Indique una falla o arreglo',
        ];
    }

   public function update()
    {
        if($this->estado==5 || $this->estado==4)
        {
            $this->validate($this->rulesFinalizar);

            $this->data->update([
                'problem'=>$this->falla,
                'report_technical'=>$this->informe_tecnico,
                'date_delivery'=> date('Y-m-d'), // Agrega la fecha del sistema
                'state_id'=>$this->estado,
            ]);

            $this->reset(['falla','informe_tecnico','estado','showModal']);
            $this->resetErrorBag();
            $this->emitTo('ordenes.ordenes-component', 'notification', [
                'message' => 'Orden actualizada exitosamente',
                'class' => "btn bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
            ]);

            if ($this->data->created_order == 'Taller') {
                return $this->exportOrdenEntrega($this->data);
            } else {
                $this->emitTo('ordenes.ordenes-component', 'notification', ['message' => 'Orden finalizada exitosamente']);
                return redirect()->route('ordenes.index');
            }

        } else {

            $this->reset(['falla','informe_tecnico','estado','showModal']);
            $this->resetErrorBag();
            $this->emitTo('ordenes.ordenes-component', 'notification', [
                'message' => 'Error al finalizar orden',
                'class' => "btn bg-error/10 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
            ]);
        }
    }

    public function exportOrdenEntrega(Ordenes $order) {

        $order_json = DB::table('orders')
                    ->where('orders.id', $order->id)
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->join('devices', 'orders.device_id', '=', 'devices.id')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('areas', 'customers.area_id', '=', 'areas.id')
                    ->join('secretaries', 'areas.secretary_id', '=', 'secretaries.id')
                    ->join('type_devices', 'devices.type_device_id', '=', 'type_devices.id')
                    ->join('brands', 'devices.brand_id', '=', 'brands.id')
                    ->join('models', 'devices.model_id', '=', 'models.id')
                    ->select('orders.id', 'orders.problem', 'orders.accessories', 'orders.date_emission', 'orders.time_emission', 'orders.date_promise', 'orders.report_customer', 'orders.date_delivery',
                            'customers.name', 'customers.lastname', 'areas.area_name', 'secretaries.secretary_name', 'customers.phone',
                            'devices.serial_number', 'type_devices.type_name', 'brands.brand_name', 'models.model_name',
                            'users.name as technical_user')
                    ->get();

        $receiver_user = User::where('id', $order->receiver_user)->first();

        // Formateo los datos para enviar a la vista
        $data = $order_json[0];
        $data->receiver_user = $receiver_user->name;
        $data->time_emission = Carbon::parse($data->time_emission)->format('H:i');

        $this->emit('exportEntregaView', ['order' => $data]);
    }

    public function close() {
        $this->reset(['falla','informe_tecnico','estado','showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.ordenes.ordenes-finalizar', ['estados'=>State::all()]);
    }
}
