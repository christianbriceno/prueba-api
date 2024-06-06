<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationRequestUpdateProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function name_is_required()
    {
        $product = Product::factory()->create();

        $response = $this->putJson(route('products.update', $product), [
            'data' => [
                'type' => 'Products',
                'attributes' => [
                    'price' => 10
                ]
            ]
        ]);

        $response->assertJsonApiValidationErrors('name');
    }

    /** @test */
    public function price_is_required()
    {
        $product = Product::factory()->create();
        $response = $this->putJson(route('products.update', $product), [
            'data' => [
                'type' => 'Products',
                'attributes' => [
                    'name' => 'new name'
                ]
            ]
        ]);

        $response->assertJsonApiValidationErrors('price');
    }

    /** @test */
    public function name_must_be_max_255_characters()
    {
        $product = Product::factory()->create();
        $response = $this->putJson(route('products.update', $product), [
            'data' => [
                'type' => 'Products',
                'attributes' => [
                    'name' => $this->genRandomString()
                ]
            ]
        ]);

        $response->assertJsonApiValidationErrors('name');
    }

    function genRandomString($length = 256)
    {
        if ($length < 1)
            $length = 1;
        return substr(preg_replace("/[^A-Za-z0-9]/", '', base64_encode(openssl_random_pseudo_bytes($length * 2))), 0, $length);
    }
}
