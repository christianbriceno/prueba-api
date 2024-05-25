<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Database\Factories\OrderProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 0; $j < 3; $j++) {

            $order = Order::factory()->create();

            for ($i = 0; $i < 3; $i++) {
                $product = Product::inRandomOrder() ? Product::inRandomOrder()->first() : null;
                $order->products()->attach($product->id);
            }
        }
    }
}
