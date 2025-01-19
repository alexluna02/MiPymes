<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;


// clase producto
class Producto extends Model
{
    use HasFactory;
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
    protected $fillable = [
        'nombre',
        'descripcion',
        'proveedor_id',
        'categoria_id',
        'precio',
        'cantidad_stock',
        'marca',
        'modelo',
        'año_fabricacion'
    ];
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    public function repuestos()
    {
        return $this->belongsToMany(Repuesto::class, 'producto_repuesto', 'producto_id', 'repuesto_id');
    }
}
