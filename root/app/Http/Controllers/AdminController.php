<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin');
    }
}
