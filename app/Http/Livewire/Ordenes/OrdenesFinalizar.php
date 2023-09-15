<?php

namespace App\Http\Livewire\Ordenes;

use Livewire\Component;
use App\Models\State;
use App\Models\Ordenes;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdenesFinalizar extends Component
{
    protected $listeners = ['finalizar', 'notification', 'exportPDF'];
    public $showModal= false;
    public $estado,$fecha_entrega,$informe_tecnico,$falla, $data;


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

    protected $rulesEstado=[
        'fecha_entrega'=>'required'
    ];

    protected function messages()
    {
        return [
            'falla.required'=>'Indique una falla o arreglo',
            'fecha_entrega.required'=>'La fecha es necesaria para finalizar la orden'
        ];
    }

   public function update()
    {
        if($this->estado==5 || $this->estado==4)
        {
            $this->validate($this->rulesEstado);
        }

        $this->validate($this->rulesFinalizar);

            $this->data->update([
                'problem'=>$this->falla,
                'report_technical'=>$this->informe_tecnico,
                'date_delivery'=>$this->fecha_entrega,
                'state_id'=>$this->estado,
            ]);

        $this->reset(['falla','informe_tecnico','fecha_entrega','estado','showModal']);
        $this->resetErrorBag();
        $this->emitTo('ordenes.ordenes-component', 'notification', ['message' => 'Orden actualizada exitosamente']);
        return $this->exportPDF($this->data);
    }

    // Export PDF
    public function exportPDF(Ordenes $order) {
        $pdf = Pdf::loadView('reports.order-completed', ['order' => $order])->output();
        return response()->streamDownload(fn() => print($pdf), 'export.pdf');
    }

    public function close() {
        $this->reset(['falla','informe_tecnico','fecha_entrega','estado','showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.ordenes.ordenes-finalizar', ['estados'=>State::all()]);
    }
}
