<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoModel;
use App\Models\PedidoDetalleModel;
use App\Models\ProveedorModel;
use App\Models\ProductoModel;
use App\Models\ProveedorProductoModel;

class StoreController extends Controller
{

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
        return response()->json(
        [
            'status' => 1,
            'datos' => $detalle
        ]);


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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
