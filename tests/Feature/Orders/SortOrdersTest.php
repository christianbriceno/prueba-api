<?php

namespace Tests\Feature\Orders;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SortOrdersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_orders_by_user_id_asc()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        Order::factory()->create(['user_id' => $userA->id]);
        Order::factory()->create(['user_id' => $userC->id]);
        Order::factory()->create(['user_id' => $userB->id]);

        $url = route('orders.index', ['sort' => 'user_id']);

        $this->getJson($url)->assertSeeInOrder([
            $userA->id,
            $userB->id,
            $userC->id,
        ]);
    }

    /** @test */
    public function it_can_sort_orders_by_user_id_desc()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        Order::factory()->create(['user_id' => $userA->id]);
        Order::factory()->create(['user_id' => $userC->id]);
        Order::factory()->create(['user_id' => $userB->id]);

        $url = route('orders.index', ['sort' => '-user_id']);

        $this->getJson($url)->assertSeeInOrder([
            $userC->id,
            $userB->id,
            $userA->id,
        ]);
    }

    /** @test */
    public function it_can_sort_orders_by_unknown_fields()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        Order::factory()->create(['user_id' => $userA->id]);
        Order::factory()->create(['user_id' => $userC->id]);
        Order::factory()->create(['user_id' => $userB->id]);

        $url = route('orders.index', ['sort' => 'unknown']);

        $this->getJson($url)->assertStatus(400);
    }
}
