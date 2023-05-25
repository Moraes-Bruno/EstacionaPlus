<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Vaga extends Model
{
   protected $connection = 'mongodb';
   protected $collection = 'vagas';
}
