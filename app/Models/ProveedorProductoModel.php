<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorProductoModel extends Model
{
    use HasFactory;
    protected $table = 'proveedor_producto';
    protected $guarded = ['id','created_at','updated_at'];

    public function proveedor()
    {
        return $this->hasOne(ProveedorModel::class, 'id','id_proveedor');
    }
    public function producto()
    {
        return $this->hasOne(ProductoModel::class, 'id','id_producto');
    }

}
