<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\User;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexOrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_orders()
    {
        $user = User::factory()->create();

        $orders = Order::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson(route('orders.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'Orders',
                    'id' => (string) $orders[0]->getRouteKey(),
                    'attributes' => [
                        'user_id' => $orders[0]->buyer->id,
                    ],
                    'links' => [
                        'self' => route('orders.show', $orders[0]->id)
                    ]
                ],
                [
                    'type' => 'Orders',
                    'id' => (string) $orders[1]->getRouteKey(),
                    'attributes' => [
                        'user_id' => $orders[1]->buyer->id,
                    ],
                    'links' => [
                        'self' => route('orders.show', $orders[1]->id)
                    ]
                ],
                [
                    'type' => 'Orders',
                    'id' => (string) $orders[2]->getRouteKey(),
                    'attributes' => [
                        'user_id' => $orders[2]->buyer->id,
                    ],
                    'links' => [
                        'self' => route('orders.show', $orders[2]->id)
                    ]
                ]
            ],
            'links' => [
                'self' => route('orders.index')
            ],
            'meta' => [
                'orders_count' => 3
            ]
        ]);
    }
}
