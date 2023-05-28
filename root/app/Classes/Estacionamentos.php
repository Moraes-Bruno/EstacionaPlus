<?php

class Estacionamento
{
    private $manager;

    public $lat;
    public $lng;
    public $nome;
    public $vagas;
    public $endereco;

    public function __construct()
    {
        // Set up the MongoDB connection
        $this->manager = new MongoDB\Driver\Manager(env('DB_URI'));
    }

    public function inserir($lat, $lng, $nome, $vagas, $endereco)
    {

        $bulkWrite = new MongoDB\Driver\BulkWrite();

        // Define the document to be inserted
        $document = [
            'latitude' => floatval($lat),
            'longitude' => floatval($lng),
            'nome' => $nome,
            'vagas' => $vagas,
            'vagas_disponiveis' => intval($vagas),
            'endereco' => $endereco,
        ];

        // Insert the document into the 'EstacionaMais.Estacionamentos' collection
        $bulkWrite->insert($document);
        $this->manager->executeBulkWrite('EstacionaMais.Estacionamentos', $bulkWrite);
    }

    public function listar()
    {
        // Define the MongoDB query
        $query = new MongoDB\Driver\Query([]);

        // Execute the query
        $cursor = $this->manager->executeQuery('EstacionaMais.Estacionamentos', $query);

        // Prepare an array to store the parking locations
        $locations = [];

        // Iterate over the query results
        foreach ($cursor as $document) {
            // Extract the relevant fields from the document
            $id = $document->_id;
            $titulo = $document->nome;
            $vagas = $document->vagas;
            $vagas_disponiveis = $document->vagas_disponiveis;
            $latitude = $document->lat;
            $longitude = $document->lng;
            $endereco = $document->endereco;

            // Create an array representing the parking location
            $location = [
                'id' => $id,
                'titulo' => $titulo,
                'vagas' => $vagas,
                'vagas_disponiveis' => $vagas_disponiveis,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'endereco' => $endereco,
            ];

            // Add the location to the array
            $locations[] = $location;
        }

        // Return the array of parking locations
        return $locations;
    }
    public function listar_especifico($id)
    {
        // Criar um objeto ObjectID com base no ID fornecido
        $objectId = new MongoDB\BSON\ObjectID($id);

        // Define o filtro com base no ID
        $filter = ['_id' => $objectId];

        // Define a query com o filtro e limita a um documento
        $query = new MongoDB\Driver\Query($filter, ['limit' => 1]);

        // Execute a query
        $cursor = $this->manager->executeQuery('EstacionaMais.Estacionamentos', $query);

        // Retorna o primeiro documento encontrado ou null se nenhum documento for encontrado
        return $cursor->toArray()[0] ?? null;
    }
}
