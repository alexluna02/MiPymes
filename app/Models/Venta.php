<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;

class Venta extends Model
{
    use HasFactory;
    protected $dispatchesEvents=['created'=>ModelCreated::class,'deleted'=>ModelDeleted::class];
    protected $fillable = [
        'id', // Este no es obligatorio, pero puedes dejarlo si estás generando IDs personalizados
        'cliente_id',
        'fecha_venta',
        'total',
        'metodo_pago_id',
        'estado',
        'fecha_entrega',
        'direccion_entrega',
        'comentarios',
    ];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }


    public function metodoPago()
    {
        return $this->belongsTo(Metodo_pago::class, 'metodo_pago_id', 'id');
    }
    public function detalles()
    {
        return $this->hasMany(Detalle_venta::class);
    }
}
