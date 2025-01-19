<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Events\ModelCreated;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelDeleted;

class MantenimientoMaquinaria extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'mantenimiento_maquinaria';
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
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
