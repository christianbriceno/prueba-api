<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_store_product()
    {
        $response = $this->postJson(route('products.store', [
            'data' => [
                'type' => 'Products',
                'attributes' => [
                    'name' => 'new product',
                    'price' => 10
                ]
            ]
        ]));

        $response->assertCreated();

        $product = Product::first();

        $response->assertHeader('location', route('products.show', $product));

        $response->assertExactJson([
            'data' => [
                'type' => 'Products',
                'id' => (string) $product->getRouteKey(),
                'attributes' => [
                    'name' => $product->name,
                    'price' => (int) $product->price
                ],
                'links' => [
                    'self' => route('products.show', $product)
                ]
            ]
        ]);
    }
}
