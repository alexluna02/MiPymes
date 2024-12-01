<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(Metodo_pago::class);
    }
}