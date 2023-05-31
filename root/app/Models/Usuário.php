<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class Usuário extends Eloquent
{
    protected $connection = 'mongodb';
    protected $table = 'usuários';
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'favoritos',
    ];
}
