<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SortProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_products_by_name_asc()
    {
        Product::factory()->create(['name' => 'C name']);
        Product::factory()->create(['name' => 'A name']);
        Product::factory()->create(['name' => 'B name']);

        $url = route('products.index', ['sort' => 'name']);

        $this->getJson($url)->assertSeeInOrder([
            'A name',
            'B name',
            'C name',
        ]);
    }

    /** @test */
    public function it_can_sort_products_by_name_desc()
    {
        Product::factory()->create(['name' => 'C name']);
        Product::factory()->create(['name' => 'A name']);
        Product::factory()->create(['name' => 'B name']);

        $url = route('products.index', ['sort' => '-name']);

        $this->getJson($url)->assertSeeInOrder([
            'C name',
            'B name',
            'A name',
        ]);
    }

    /** @test */
    public function it_can_sort_products_by_name_asc_and_price_desc()
    {
        Product::factory()->create([
            'name' => 'C name',
            'price' => 1
        ]);
        Product::factory()->create([
            'name' => 'A name',
            'price' => 2
        ]);
        Product::factory()->create([
            'name' => 'B name',
            'price' => 3
        ]);

        $url = route('products.index', ['sort' => 'name,-price']);

        $this->getJson($url)->assertSeeInOrder([
            'A name',
            'B name',
            'C name',
        ]);
    }

    /** @test */
    public function it_can_sort_products_by_unknown_fields()
    {
        Product::factory()->count(3)->create();

        $url = route('products.index', ['sort' => 'unknown']);

        $this->getJson($url)->assertStatus(400);
    }
}
