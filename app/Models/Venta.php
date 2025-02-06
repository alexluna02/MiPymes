<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Events\ModelDeleted;

class Venta extends Model
{
    use HasFactory;
    protected $dispatchesEvents=['deleted'=>ModelDeleted::class];
    protected $fillable = [
        'id', // Este no es obligatorio, pero puedes dejarlo si estás generando IDs personalizados
        'cod_factura',
        'cliente_id',
        'fecha_venta',
        'total',
        'metodo_pago_id',
        
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
