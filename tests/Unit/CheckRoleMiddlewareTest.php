<?php
namespace Tests\Unit\Middleware;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\CheckRole;
use App\Models\User;

class CheckRoleMiddlewareTest extends TestCase
{
    public function test_user_with_correct_role_can_access()
    {
        // Create a mock user with the 'Admin' role
        $user = User::factory()->make(['role' => 'Admin']);

        // Authenticate the user
        Auth::shouldReceive('user')->andReturn($user);

        // Create a mock request
        $request = Request::create('/admin', 'GET');

        // Apply the middleware
        $middleware = new CheckRole();
        $response = $middleware->handle($request, fn() => response('OK'), 'Admin');

        // Assert the response is OK
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_user_with_incorrect_role_is_redirected()
    {
        // Create a mock user with the 'Seller' role
        $user = User::factory()->make(['role' => 'Seller']);

        // Authenticate the user
        Auth::shouldReceive('user')->andReturn($user);

        // Create a mock request
        $request = Request::create('/admin', 'GET');

        // Apply the middleware
        $middleware = new CheckRole();
        $response = $middleware->handle($request, fn() => response('OK'), 'Admin');

        // Assert redirection to seller.dashboard
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString(route('seller.dashboard'), $response->headers->get('Location'));
    }

    public function test_unauthenticated_user_is_redirected_to_login()
    {
        // No authenticated user
        Auth::shouldReceive('user')->andReturn(null);

        // Create a mock request
        $request = Request::create('/admin', 'GET');

        // Apply the middleware
        $middleware = new CheckRole();
        $response = $middleware->handle($request, fn() => response('OK'), 'Admin');

        // Assert redirection to login
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString(route('login'), $response->headers->get('Location'));
    }
}
