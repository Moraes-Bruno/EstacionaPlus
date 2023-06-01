<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;

class EstacionamentoController extends Controller
{
    public function show()
    {
        $estacionamentos = Estacionamento::all();
        return view('index', ['estacionamentos' => $estacionamentos]);
    }

    public function showIndex2()
    {
        $estacionamentos = Estacionamento::all();
        return view('index2', ['estacionamentos' => $estacionamentos]);
    }
    
    public function estacionamentos_form($_id = false)
    {
        if($_id){
            $dados = Estacionamento::findOrFail($_id);
            return view('estacionamentos_form', compact('dados'));
        }
        else{
            return view('estacionamentos_form');
        }
    }
    public function inserir(Request $request)
    {
        $dados = new Estacionamento($request->all());
        $dados->save();
        return redirect()->route('estacionamentos.listar');
    }

    public function listar()
    {
        $estacionamentos = Estacionamento::all();
        return view('exibir_estacionamentos', compact('estacionamentos'));
    }
    public function listar_um($id)
    {
        $dados = Estacionamento::findOrFail($id);
        return view('detalhes_estacionamentos', compact('dados'));
    }
    public function alterar(Request $request, $id)
    {
        $dados = Estacionamento::findOrFail($id);
        $dados->nome = $request->nome;
        $dados->latitude = $request->latitude;
        $dados->longitude = $request->longitude;
        $dados->vagas = $request->vagas;
        $dados->endereco = $request->endereco;
        $dados->tipo = $request->tipo;
        $dados->totalX = $request->totalX;
        $dados->totalY = $request->totalY;
        $dados->save();
        return redirect()->route('estacionamentos.listar');
    }
    public function excluir($id)
    {
        $dados = Estacionamento::destroy($id);
        return redirect()->route('estacionamentos.listar');
    }

}
