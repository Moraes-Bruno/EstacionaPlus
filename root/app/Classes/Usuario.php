<?php

class Usuario
{
private $manager;

public $nome;
public $email;
public $senha;
public $favoritos;

public function __construct()
{
// Set up the MongoDB connection
$this->manager = new MongoDB\Driver\Manager(env('DB_URI'));
}

public function listar()
{
// Define the MongoDB query
$query = new MongoDB\Driver\Query([]);

// Execute the query
$cursor = $this->manager->executeQuery('EstacionaMais.Usuarios', $query);

$usuarios = [];

foreach ($cursor as $document) {

$id = $document->_id;
$nome = $document->nome;
$email = $document->email;
$favoritos = $document->favoritos;

$usuario = [
'id' => $id,
'nome' => $nome,
'email' => $email,
'favoritos' => count($favoritos),
];

// Add the location to the array
$usuarios[] = $usuario;
}

// Return the array of parking locations
return $usuarios;
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
$cursor = $this->manager->executeQuery('EstacionaMais.Usuarios', $query);

// Retorna o primeiro documento encontrado ou null se nenhum documento for encontrado
return $cursor->toArray()[0] ?? null;
}
}
