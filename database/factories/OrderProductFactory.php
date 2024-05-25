<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $order = Order::inRandomOrder()->first();
        $product = Product::inRandomOrder() ? Product::inRandomOrder()->first() : null;

        return [
            'order_id'   => $order->id,
            'product_id' => $product->id,
        ];
    }
}
