<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;

class Metodo_pago extends Model
{
    use HasFactory;
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
    protected $fillable = ['metodo', 'descripcion'];

    protected $table='metodo_pago';
}
