<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_checks_for_user_in_view_if_id_is_passed_as_querystring()
    {
        $user = User::factory()->create();

        $response = $this->get("/?id={$user->id}");
        
        $response->assertViewHas('user', $user);
    }

    public function test_it_checks_for_user_in_view_if_id_is_passed_as_route_params()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}");
        
        $response->assertViewHas('user', $user);
    }
}
