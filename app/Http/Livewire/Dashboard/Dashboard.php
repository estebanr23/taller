<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use App\Models\Ordenes;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use WithPagination;

    public int $status = 0;
    public int $technician = 0;
    public string $search = '';
    public int $pages = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = null;
        if (Auth::user()->role == 'administrador') {
            if ($this->status == 0 && $this->technician == 0) {
                $orders = Ordenes::where('device_id', 'like', '%'.$this->search.'%')->orderBy('date_emission', 'desc')->paginate($this->pages);
            } else if($this->status > 0) {
                $orders = Ordenes::where('device_id', 'like', '%'.$this->search.'%')->whereStateId($this->status)->orderBy('date_emission', 'desc')->paginate($this->pages);
                $this->status = 0;
            } else {
                $orders = Ordenes::where('device_id', 'like', '%'.$this->search.'%')->whereUserId($this->technician)->orderBy('date_emission', 'desc')->paginate($this->pages);
                $this->technician = 0;
            }
        } else {
            if ($this->status == 0) {
                $orders = Ordenes::whereUserId(Auth::user()->id)->where('device_id', 'like', '%'.$this->search.'%')->orderBy('date_emission', 'desc')->paginate($this->pages);
            } else {
                $orders = Ordenes::whereUserId(Auth::user()->id)->where('device_id', 'like', '%'.$this->search.'%')->orderBy('date_emission', 'desc')->whereStateId($this->status)->paginate($this->pages);
            }
        }
        
        return view('livewire.dashboard.dashboard', [
            'orders' => $orders,
            'technicians' => User::whereRole('tecnico')->get()
        ]);
    }
}
