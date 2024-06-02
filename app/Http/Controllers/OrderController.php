<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::without('products')->get();

        return response()->json(['orders' => $orders, 'code' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json(['order' => $order, 'code' => 200]);
    }

    /**
     * Obtiene todos los productos de un pedido.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function productsOfAnOrder(Order $order)
    {
        $products = $order->products;
        return response()->json(['products' => $products, 'code' => 200]);
    }
}
