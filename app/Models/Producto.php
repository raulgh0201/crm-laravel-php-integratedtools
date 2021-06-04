<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ["codigo_barras", "descripcion", "precio_compra", "precio_venta", "existencia",
    ];
}
