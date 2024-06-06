<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
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
        $orders = Order::ApplySorts(request('sort'))->get();

        return OrderCollection::make($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return OrderResource::make($order);
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
