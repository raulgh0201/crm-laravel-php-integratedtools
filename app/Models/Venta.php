<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function productos()
    {
        return $this->hasMany("App\Models\ProductoVendido", "id_venta");
    }

    public function cliente()
    {
        return $this->belongsTo("App\Models\Contact", "id_cliente");
    }
}
