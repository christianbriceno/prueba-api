<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Obtiene una lista de todos los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::applySorts(request('sort'))->get();

        return ProductCollection::make($products);
    }

    /**
     * Agrega un nuevo producto
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated('data.attributes'));

        return ProductResource::make($product);
    }

    /**
     * Obtiene un producto especifico
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
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
        $product->update($request->validated('data.attributes'));

        return ProductResource::make($product);
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

        return ProductResource::make($product);
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
