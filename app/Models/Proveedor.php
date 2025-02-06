<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\ModelDeleted;


class Proveedor extends Model
{
    protected $dispatchesEvents=['deleted'=>ModelDeleted::class];
    
    use HasFactory;
    public $timestamps = false;
    protected $table = 'proveedores';
    protected $fillable = ['nombre','direccion','telefono','email','fecha_registro'];
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}
