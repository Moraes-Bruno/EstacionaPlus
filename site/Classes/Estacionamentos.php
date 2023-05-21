<?php

class Estacionamento
{
    private $manager;

    public function __construct()
    {
        // Set up the MongoDB connection
        $this->manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
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
            $titulo = $document->nome;
            $vagas = $document->vagas;
            $vagas_disponiveis = $document->vagas_disponiveis;
            $latitude = $document->latitude;
            $longitude = $document->longitude;
            $endereco = $document->endereco;

            // Create an array representing the parking location
            $location = [
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
}
