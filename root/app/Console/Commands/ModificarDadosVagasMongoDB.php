<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MongoDB\Client as MongoDBClient;

class ModificarDadosVagasMongoDB extends Command
{
    /*
      The name and signature of the console command.
     */
    protected $signature = 'mongodb:modificar-status-vagas';

    /*
      The console command description.
    */
    protected $description = 'Modifica status das vagas no MongoDB';

    /*
      Execute the console command.
     */
    public function handle()
    {
        $mongoDBUri = env('DB_URI');

        $client = new MongoDBClient($mongoDBUri);



        // Seleciona o banco de dados e a coleção (ajuste conforme necessário)
        $database = $client->selectDatabase('laravelmongo');
        $collection = $database->selectCollection('estacionamentos');



        // Lógica para modificar os status das vagas em todos os documentos
        $updates = [];
        for ($i = 0; $i < 12; $i++) {
            for ($j = 0; $j < 24; $j++) {
                $index = "$i,$j";
                $status = rand(0, 1);

                // Utiliza o operador $set para modificar apenas o campo 'Status'
                $updates[] = [
                    'q' => [], // Query vazia para atualizar todos os documentos
                    'u' => [
                        '$set' => [
                            'vagas.' . $index . '.Status' => $status
                        ]
                    ],
                ];
            }
        }

        // Atualiza os status das vagas em todos os documentos
        foreach ($updates as $update) {
            $collection->updateMany($update['q'], $update['u']);
        }

        $this->info('Status das vagas modificados no MongoDB!');
    }
}
