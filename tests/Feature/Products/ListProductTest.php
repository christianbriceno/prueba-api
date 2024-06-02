<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_products()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->getJson(route('products.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'articles',
                    'id' => (string) $products[0]->getRouteKey(),
                    'attributes' => [
                        'name' => $products[0]->name,
                        'price' => $products[0]->price
                    ],
                    'links' => [
                        'self' => route('products.show', $products[0]->id)
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $products[1]->getRouteKey(),
                    'attributes' => [
                        'name' => $products[1]->name,
                        'price' => $products[1]->price
                    ],
                    'links' => [
                        'self' => route('products.show', $products[1]->id)
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $products[2]->getRouteKey(),
                    'attributes' => [
                        'name' => $products[2]->name,
                        'price' => $products[2]->price
                    ],
                    'links' => [
                        'self' => route('products.show', $products[2]->id)
                    ]
                ]
            ],
            'links' => [
                'self' => route('products.index')
            ],
            'meta' => [
                'products_count' => 3
            ]
        ]);
    }

    /** @test */
    public function can_fetch_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('products.show', $product->id));

        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
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
