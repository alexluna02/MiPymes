<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;

class Parametro extends Model
{
    use HasFactory;
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
    protected $fillable = ['nombre', 'valor', 'descripcion', 'tipo'];
}