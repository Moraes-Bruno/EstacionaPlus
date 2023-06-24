<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;

class EstacionamentoController extends Controller
{
    public function show()
    {
        return view('index');
    }
    public function showIndex2()
    {
        $estacionamentos = Estacionamento::all();
        return view('index2', ['estacionamentos' => $estacionamentos]);
    }
    public function showhome()
    {
        $estacionamentos = Estacionamento::all();
        return view('home', ['estacionamentos' => $estacionamentos]);
    }
    public function estacionamentos_form($_id = false)
    {
        if ($_id) {
            $dados = Estacionamento::findOrFail($_id);
            return view('estacionamentos_form', compact('dados'));
        } else {
            return view('estacionamentos_form');
        }
    }
    public function inserir(Request $request)
    {
        // Obtenha os dados do formulário
        $dados = $request->all();

        // Crie uma matriz para armazenar as informações das vagas
        $vagas = [];

        // Percorra os dados do formulário para extrair as informações das vagas
        for ($i = 0; $i < 12; $i++) {
            for ($j = 0; $j < 24; $j++) {
                $index = "$i,$j";
                $tipoVaga = $dados["tipoVaga$index"];
                $status = $this->gerarStatusVaga();
                $vaga = [
                    'Posição' => $index,
                    'Tipo' => $tipoVaga,
                    'Status' => $status
                ];
                $vagas[$index] = $vaga;
            }
        }

        // Adicione as informações das vagas aos dados do estacionamento
        $dados['vagas'] = $vagas;

        // Crie um novo registro de estacionamento com os dados fornecidos
        $estacionamento = new Estacionamento();
        $estacionamento->fill($dados);
        $estacionamento->save();

        return redirect()->route('estacionamentos.listar');
    }
    private function gerarStatusVaga()
    {
        return rand(0, 1);
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
        $dados->totalVagas = $request->totalVagas;
        $dados->endereco = $request->endereco;

        $vagas = [];

        // Percorra os dados do formulário para extrair as informações das vagas
        for ($i = 0; $i < 12; $i++) {
            for ($j = 0; $j < 24; $j++) {
                $index = "$i,$j";
                $tipoVaga = $request->input("vagas.$index.Tipo");
                $status = $request->input("vagas.$index.Status");
                $vaga = [
                    'Posição' => $index,
                    'Tipo' => $tipoVaga,
                    'Status' => $status,
                ];
                $vagas[$index] = $vaga;
            }
        }

        // Adicione as informações das vagas aos dados do estacionamento
        $dados->vagas = $vagas;
        $dados->save();

        return redirect()->route('estacionamentos.listar');
    }


    public function excluir($id)
    {
        $dados = Estacionamento::destroy($id);
        return redirect()->route('estacionamentos.listar');
    }
}
