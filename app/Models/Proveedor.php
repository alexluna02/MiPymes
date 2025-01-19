<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;


class Proveedor extends Model
{
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
    
    use HasFactory;
    public $timestamps = false;
    protected $table = 'proveedores';
    protected $fillable = ['nombre','direccion','telefono','email','fecha_registro'];
}
