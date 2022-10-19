<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoModel;
use App\Models\PedidoDetalleModel;
use App\Models\ProveedorModel;
use App\Models\ProductoModel;
use App\Models\ProveedorProductoModel;

class StoreController extends Controller {

    /**
     * list_pedidos : lista todos los pedidos siempre que esten en estado 1
     * Nota: El campo estado unicamente es para saber si es visible o no en el aplicativo,
     * Para obtener informacion del estado de tramite del pedido se tiene el campo "tramite"
     * variables: No Aplica
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
    public function list_pedidos(){
        return response()->json(
            ['status' => 1,
            'datos' => PedidoModel::select('*')->where('pe_estado',1)->with('cliente')->get()
        ]);
    }


    /**
     * detail_pedido : permite mostrar los productos de un solo pedido(No_pedido)
     * variables: [No_pedido]
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
    public function detail_pedido()
    {
        $datos = Request()->validate(['No_pedido' => 'required|integer',]);
        $detalle = PedidoModel::select('*')->where('id',$datos['No_pedido'])->with('cliente')->get();
        $detalle['productos']= PedidoDetalleModel::select('*')->where('id_pedido',$datos['No_pedido'])->with('detalle')->get();
        return response()->json(['status' => 1,'datos' => $detalle]);
    }


    /**
     * list_proveedores : lista todos los proveedores siempre que esten en estado 1
     * variables: No Aplica
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
    public function list_proveedores(){
        return response()->json(
            ['status' => 1,
            'datos' => ProveedorModel::select('*')->where('pv_estado',1)->get()
        ]);
    }


    /**
     * list_productos : lista todos los productos siempre que esten en estado 1
     * variables: No Aplica
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
    public function list_productos(){
        return response()->json(
            ['status' => 1,
            'datos' => ProductoModel::select('*')->where('p_estado',1)->get()
        ]);
    }


    /**
     * list_proveedores_producto : permite mostrar que proveedores surten un producto en especifico (producto)
     * variables: [producto]->id tabla producto
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
    public function list_proveedores_producto()
    {
        $datos = Request()->validate(['producto' => 'required|integer',]);
        $detalle = ProveedorProductoModel::select('*')->where('id_producto',$datos['producto'])->with('proveedor','producto')->get();
        //$detalle['productos']= PedidoDetalleModel::select('*')->where('id_pedido',$datos['No_pedido'])->with('detalle')->get();
        return response()->json(
            [
                'status' => 1,
                'datos' => $detalle
            ]);
    }

  /**
     * store_send : permite enviar o tramitar los pedidos)
     * variables: [No_pedido]-> id tabla pedidos
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
  public function store_send()
  {
    $datos = Request()->validate(['No_pedido' => 'required|integer',]);
    $detalle['productos']= PedidoDetalleModel::select('*')->where('id_pedido',$datos['No_pedido'])->with('detalle')->get();

    if(count($detalle['productos']) != 0){

        foreach($detalle['productos'] as $registro  ){

            $var['id']=$registro->id_producto;
            $var['cantidad']=$registro->p__d_cantidad;
            $var['bodega']=$registro->detalle[0]->p_cantidad;
            $var['nom_producto']=$registro->detalle[0]->p_nombre;
            $total_inventario=$var['bodega'] -$var['cantidad'];
            if($total_inventario >=0){
                $estado=ProductoModel::where('id',  $var['id'])->update(['p_cantidad' => $total_inventario]);
                $estado = true;
            }
            else{
                return response()->json( [ 'status' => 0,'error' => "No se pudo completar la transferencia de :". $var['nom_producto'] ]);
                die();
            }
        }

        if($estado){
            $estado=PedidoModel::where('id', $datos['No_pedido'])->update(['pe_tramite' => 'Enviado']);
            return response()->json(
                ['status' => 1,
                'datos' => "Exito al guardar"
            ]);
        }
        else{
            return response()->json( [ 'status' => 0,'error' => "Cantidad de productos inconsistente. ¿Valida el stock?" ]);
        }
    }
    else{
     return response()->json( [ 'status' => 0,'error' => "Pedido sin productos." ]);
 }
}


  /**
     * store_add : permite cargar o actualizar nuevos productos)
     * variables: [No_provedor_producto]-> id tabla proveedor productos , [valor]-> Cantidad e productos a comprar
     * token: validado por middleware Auht:sanctum
     * Dev: Sebastian Carvajal 15/10/2022
     */
  public function store_add()
  {
    $datos = Request()->validate(['No_provedor_producto' => 'required|integer','valor' => 'required|integer',]);
    $producto=ProveedorProductoModel::select('*')->where('id',$datos['No_provedor_producto'])->with('producto')->get();
    $total_inventario = $producto[0]->producto->p_cantidad + $datos['valor'];
    $estado= ProductoModel::where('id',  $producto[0]->id_producto)->update(['p_cantidad' => $total_inventario]);
    return response()->json( ['status' => 1, 'datos' => "Exito al comprar nuevos productos"]);
}

}
