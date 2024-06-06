<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_delete_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('products.destroy', $product->id));

        $this->assertDatabaseMissing('products', [$product]);

        $response->assertExactJson([
            'data' => [
                'status' => 200
            ]
        ]);
    }
}
