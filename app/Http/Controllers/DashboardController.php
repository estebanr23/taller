<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $countOrders = Ordenes::count();
        $countOrdersCompleted = DB::table('orders')
                                ->join('states', 'states.id', '=', 'orders.state_id')
                                ->where('state_id', '=', '5')
                                ->count();
        $countOrdersPending = DB::table('orders')
                                ->join('states', 'states.id', '=', 'orders.state_id')
                                ->where('state_id', '=', '2')
                                ->count();
        $countOrdersWithoutAssign = Ordenes::whereNull('user_id')->count();

        return view('index', [
            'count_orders' => $countOrders,
            'countOrdersCompleted' => $countOrdersCompleted,
            'countOrdersPending' => $countOrdersPending,
            'countOrdersWithoutAssign' => $countOrdersWithoutAssign
        ]);
    }
}
