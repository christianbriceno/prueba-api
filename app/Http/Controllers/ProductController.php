<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Obtiene una lista de todos los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json(['products' => $products, 'code' => 200]);
    }

    /**
     * Agrega un nuevo producto
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json(['product' => $product, 'code' => 200]);
    }

    /**
     * Obtiene un producto especifico
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['product' => $product, 'code' => 200]);
    }

    /**
     * Actualiza los datos de un producto.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json(['product' => $product, 'code' => 200]);
    }

    /**
     * Elimina un producto.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['product' => $product, 'code' => 200]);
    }

    /**
     * Obtiene todos los productos que ha comprado un usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function productsThatAUserHasPurchased(User $user)
    {
        $products = $user->orders->pluck('products')->flatten(1)->unique();

        return response()->json(['products' => $products, 'code' => 200]);
    }
}
