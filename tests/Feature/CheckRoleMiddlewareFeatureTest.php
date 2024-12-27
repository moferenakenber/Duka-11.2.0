<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddlewareFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_route()
    {
        // Create an admin user
        $admin = User::factory()->create(['role' => 'Admin']);

        // Authenticate as admin
        $this->actingAs($admin);

        // Access the admin route
        $response = $this->get('/admin');

        // Assert successful access
        $response->assertStatus(200);
    }

    public function test_seller_cannot_access_admin_route()
    {
        // Create a seller user
        $seller = User::factory()->create(['role' => 'Seller']);

        // Authenticate as seller
        $this->actingAs($seller);

        // Attempt to access the admin route
        $response = $this->get('/admin');

        // Assert redirection to seller dashboard
        $response->assertRedirect(route('seller.dashboard'));
        $response->assertSessionHas('error', 'You do not have access to this page.');
    }

    public function test_unauthenticated_user_is_redirected_to_login()
    {
        // Simulate an unauthenticated user (ensure no user is authenticated)
        Auth::shouldReceive('user')->andReturnNull();

        // Attempt to access the admin route without authentication
        $response = $this->get('/admin');

        // Assert redirection to login
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'You need to be logged in!');
    }
}
