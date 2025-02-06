<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','cedula', 'direccion', 'telefono','email','fecha_registro'];
    protected $dispatchesEvents=['deleted'=>ModelDeleted::class];
}