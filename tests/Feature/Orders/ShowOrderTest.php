<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowOrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_order()
    {
        $user = User::factory()->create();

        $order = Order::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson(route('orders.show', $order->id));

        $response->assertExactJson([
            'data' => [
                'type' => 'Orders',
                'id' => (string) $order->getRouteKey(),
                'attributes' => [
                    'user_id' => $order->buyer->id,
                ],
                'links' => [
                    'self' => route('orders.show', $order->id)
                ]
            ]
        ]);
    }
}
