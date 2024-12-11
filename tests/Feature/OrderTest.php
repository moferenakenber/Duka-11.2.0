<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateOrderTest()
    {
        $response = $this->postJson('/api/order', [/* data */]);
        $response->assertStatus(201);
    }
}