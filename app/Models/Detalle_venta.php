<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    use HasFactory;
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal', 'descuento', 'impuesto', 'total_linea'];

    protected $table = 'detalle_venta';
    
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
