<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenesController extends Controller
{
    public function index()
    {
        return view('ordenes.index');
    }

    public function create()
    {
        return view('ordenes.create');
    }
}
