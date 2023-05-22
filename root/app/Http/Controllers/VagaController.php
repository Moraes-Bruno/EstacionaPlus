<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaController extends Controller
{
   public function show()
   {
       return view('welcome', [
           'vagas' => Vaga::all()
       ]);
   }
}