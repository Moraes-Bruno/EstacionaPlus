<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class Admin extends Eloquent
{
    protected $connection = 'mongodb';
    protected $table = 'admin';
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];
}



?>