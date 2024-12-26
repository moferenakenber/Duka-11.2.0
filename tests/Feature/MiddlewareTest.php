<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class MiddlewareTest extends TestCase
{
    /**
     * Test if admin route is accessible by admin user.
     */
    public function test_admin_can_access_admin_routes(): void
    {
        $admin = User::factory()->create([
            'role' => 'Admin'
        ]);
        $this->actingAs($admin);

        // Test that an admin can access the /dashboard route
        $response = $this->get('/dashboard');
        $response->assertStatus(200); // Admin should have access to dashboard
    }

    /**
     * Test if seller cannot access admin routes and is redirected.
     */
    public function test_seller_cannot_access_admin_routes(): void
    {
        $seller = User::factory()->create([
            'role' => 'Seller'
        ]);
        $this->actingAs($seller);

        // Test that a seller cannot access the /items route and is redirected
        $response = $this->get('/items');
        $response->assertRedirect('/seller')->assertSessionHas('error', 'You do not have access to this page.');

        // Test that a seller cannot access the /user_managements route and is redirected
        $response = $this->get('/user_managements');
        $response->assertRedirect('/seller')->assertSessionHas('error', 'You do not have access to this page.');
    }

    /**
     * Test if stock keeper cannot access admin routes and is redirected.
     */
    public function test_stock_keeper_cannot_access_admin_routes(): void
    {
        $stockKeeper = User::factory()->create([
            'role' => 'stock_keeper'
        ]);
        $this->actingAs($stockKeeper);

        // Test that a stock keeper cannot access the /items route and is redirected
        $response = $this->get('/items');
        $response->assertRedirect('/stock_keeper')->assertSessionHas('error', 'You do not have access to this page.');

        // Test that a stock keeper cannot access the /user_managements route and is redirected
        $response = $this->get('/user_managements');
        $response->assertRedirect('/stock_keeper')->assertSessionHas('error', 'You do not have access to this page.');
    }

    /**
     * Test if seller is redirected to their own dashboard.
     */
    public function test_seller_is_redirected_to_seller_dashboard(): void
    {
        $seller = User::factory()->create([
            'role' => 'Seller'
        ]);
        $this->actingAs($seller);

        // Test that a seller cannot access the /dashboard route and is redirected to their own dashboard
        $response = $this->get('/dashboard');
        $response->assertRedirect('/seller');
    }

    /**
     * Test if stock keeper is redirected to their own dashboard.
     */
    public function test_stock_keeper_is_redirected_to_stock_keeper_dashboard(): void
    {
        $stockKeeper = User::factory()->create([
            'role' => 'stock_keeper'
        ]);
        $this->actingAs($stockKeeper);

        // Test that a stock keeper cannot access the /dashboard route and is redirected to their own dashboard
        $response = $this->get('/dashboard');
        $response->assertRedirect('/stock_keeper');
    }

    /**
     * Test if an unauthenticated user is redirected to login page.
     */
    public function test_unauthenticated_user_is_redirected(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
