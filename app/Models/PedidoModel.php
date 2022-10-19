<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoModel extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    protected $guarded = ['id','created_at','updated_at'];

    public function cliente()
    {
        return $this->hasOne(ClienteModel::class, 'id','id_cliente');
    }


}
