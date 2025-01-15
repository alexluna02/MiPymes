<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;

    protected $table = 'repuestos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad_stock',
        'categoria_id',
        'marca',
        'modelo',
        'año_fabricacion',
    ];

    // Relación con la tabla de categorías (asumiendo que tienes un modelo Categoria)
   /* public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
*/
    // Relación con la tabla de productos a través de la tabla intermedia
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_repuesto', 'repuesto_id', 'producto_id');
    }
}

