<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('products.show', $product->id));

        $response->assertExactJson([
            'data' => [
                'type' => 'Products',
                'id' => (string) $product->getRouteKey(),
                'attributes' => [
                    'name' => $product->name,
                    'price' => $product->price
                ],
                'links' => [
                    'self' => route('products.show', $product->id)
                ]
            ]
        ]);
    }
}
