<?php

namespace Tests\Feature;

use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateOrderItemTest()
    {
        $response = $this->postJson('/api/order_item', [/* data */]);
        $response->assertStatus(201);
    }
}