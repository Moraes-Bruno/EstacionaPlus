<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class Estacionamento extends Eloquent
{
    protected $connection = 'mongodb';
    protected $table = 'estacionamentos';
    protected $fillable = [
        'nome',
        'latitude',
        'longitude',
        'totalVagas',
        'endereco',
        'vagas',
        'tipoVagas',
        'status',
    ];
}
