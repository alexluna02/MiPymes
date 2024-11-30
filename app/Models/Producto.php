<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// clase producto
class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',  
        'precio',
        'cantidad_stock',
        'tipo_producto',
        'categoria',
        'marca',
        'modelo',
        'año_fabricacion'
    ];

}
