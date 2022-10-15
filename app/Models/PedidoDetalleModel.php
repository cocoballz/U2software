<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalleModel extends Model
{
    use HasFactory;
    protected $table = 'pedido_detalle';
    protected $guarded = ['id','created_at','updated_at'];


    public function detalle()
    {
        return $this->hasMany(ProductoModel::class, 'id','id_producto');
        
    }
}
