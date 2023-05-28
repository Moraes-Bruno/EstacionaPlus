<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\BSON\ObjectID;

class UsuarioController extends Controller
{
    private $manager;

    public function __construct()
    {
        // Set up the MongoDB connection
        $this->manager = new Manager(env('DB_URI'));
    }
    public function inserir(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $senha = $request->input('senha');
        $favoritos = $request->input('favoritos');

        $bulkWrite = new \MongoDB\Driver\BulkWrite();

        // Define the document to be inserted
        $document = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'favoritos' => $favoritos,
        ];

        // Insert the document into the 'EstacionaMais.Estacionamentos' collection
        $bulkWrite->insert($document);
        $this->manager->executeBulkWrite('EstacionaMais.Usuarios', $bulkWrite);
        return redirect()->route('admin.usuarios');
    }
    public function alterar(Request $request)
    {
        // Obter os dados do formulário
        $id = $request->input('id');
        $novosValores = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'senha' => $request->input('senha'),
            'favoritos' => $request->input('favoritos'),
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
        $this->manager->executeBulkWrite('EstacionaMais.Usuarios', $updateQuery);

        return redirect()->route('admin.usuarios');
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
        $this->manager->executeBulkWrite('EstacionaMais.Usuarios', $delete);

        return redirect()->route('admin.usuarios');
    }
}
