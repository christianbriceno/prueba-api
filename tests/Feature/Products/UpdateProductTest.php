<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_update_product()
    {
        $product = Product::factory()->create();

        $response = $this->putJson(route('products.update', $product), [
            'data' => [
                'type' => 'products',
                'attributes' => [
                    'name' => 'updated product',
                    'price' => 15
                ]
            ]
        ]);

        $response->assertSuccessful()->dump();

        $response->assertHeader('location', route('products.show', $product));

        $response->assertExactJson([
            'data' => [
                'type' => 'Products',
                'id' => (string) $product->getRouteKey(),
                'attributes' => [
                    'name' => 'updated product',
                    'price' => 15
                ],
                'links' => [
                    'self' => route('products.show', $product)
                ]
            ]
        ]);
    }
}
