<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\BSON\ObjectID;

class EstacionamentoController extends Controller
{
    private $manager;

    public function __construct()
    {
        // Set up the MongoDB connection
        $this->manager = new Manager(env('DB_URI'));
    }

    public function inserir(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $nome = $request->input('nome');
        $vagas = $request->input('totalVagas');
        $endereco = $request->input('endereco');
        $tipo = $request->input('tipo');
        $totalX = $request->input('totalX');
        $totalY = $request->input('totalY');

        $bulkWrite = new \MongoDB\Driver\BulkWrite();

        // Define the document to be inserted
        $document = [
            'lat' => floatval($lat),
            'lng' => floatval($lng),
            'nome' => $nome,
            'vagas' => $vagas,
            'vagas_disponiveis' => intval($vagas),
            'endereco' => $endereco,
            'tipo' => $tipo,
            'totalX' => $totalX,
            'totalY' => $totalY,
        ];

        // Insert the document into the 'EstacionaMais.Estacionamentos' collection
        $bulkWrite->insert($document);
        $this->manager->executeBulkWrite('EstacionaMais.Estacionamentos', $bulkWrite);
        return redirect()->route('admin.estacionamentos');
    }

    public function listar()
    {
        // Define the MongoDB query
        $query = new Query([]);

        // Execute the query
        $cursor = $this->manager->executeQuery('EstacionaMais.Estacionamentos', $query);

        // Prepare an array to store the parking locations
        $locations = [];

        // Iterate over the query results
        foreach ($cursor as $document) {
            // Extract the relevant fields from the document
            $titulo = $document->nome;
            $vagas = $document->vagas;
            $vagas_disponiveis = $document->vagas_disponiveis;
            $latitude = $document->lat;
            $longitude = $document->lng;
            $endereco = $document->endereco;
            $tipo = $document->tipo;
            $totalX = $document->totalX;
            $totalY = $document->totalY;

            // Create an array representing the parking location
            $location = [
                'titulo' => $titulo,
                'vagas' => $vagas,
                'vagas_disponiveis' => $vagas_disponiveis,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'endereco' => $endereco,
                'tipo' => $tipo,
                'totalX' => $totalX,
                'totalY' => $totalY,
            ];

            // Add the location to the array
            $locations[] = $location;
        }

        // Return the array of parking locations
        return view('index', compact('locations'));
    }
    public function alterar(Request $request)
    {
        // Obter os dados do formulário
        $id = $request->input('id');
        $novosValores = [
            'lat' => floatval($request->input('lat')),
            'lng' => floatval($request->input('lng')),
            'nome' => $request->input('nome'),
            'vagas' => $request->input('totalVagas'),
            'vagas_disponiveis' => intval($request->input('totalVagas')),
            'endereco' => $request->input('endereco'),
            'tipo' => $request->input('tipo'),
            'totalX' => $request->input('totalX'),
            'totalY' => $request->input('totalY'),
        ];
        $objectId = new ObjectID($id);

        // Define o filtro com base no ID
        $filter = ['_id' => $objectId];

        // Define as atualizações a serem aplicadas
        $update = ['$set' => $novosValores];

        // Define as opções da atualização
        $options = ['multi' => false];

        // Cria um objeto de atualização
        $updateQuery = new \MongoDB\Driver\BulkWrite();
        $updateQuery->update($filter, $update, $options);

        // Executa a atualização
        $this->manager->executeBulkWrite('EstacionaMais.Estacionamentos', $updateQuery);

        return redirect()->route('admin.estacionamentos');
    }
    public function excluir(Request $request)
    {
        // Obter os dados do formulário
        $id = $request->input('id');

        $objectId = new ObjectID($id);

        // Define o filtro com base no ID
        $filter = ['_id' => $objectId];

        // Cria um objeto de atualização
        $delete = new \MongoDB\Driver\BulkWrite();
        $delete->delete($filter);

        // Executa a atualização
        $this->manager->executeBulkWrite('EstacionaMais.Estacionamentos', $delete);

        return redirect()->route('admin.estacionamentos');
    }
}
