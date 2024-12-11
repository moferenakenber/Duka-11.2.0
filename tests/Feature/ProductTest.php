<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateProductTest()
    {
        $response = $this->postJson('/api/product', [/* data */]);
        $response->assertStatus(201);
    }
}