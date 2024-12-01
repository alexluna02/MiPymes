<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MantenimientoMaquinaria extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'mantenimiento_maquinaria';

    // Campos asignables
    protected $fillable = [
        'producto_id',
        'venta_id',
        'fecha_mantenimiento',
        'tipo_mantenimiento',
        'descripcion',
        'costo',
        'estado_post_mantenimiento',
    ];

    // Relación con la tabla 'producto'
    /* public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Relación con la tabla 'venta'
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    } */
}
