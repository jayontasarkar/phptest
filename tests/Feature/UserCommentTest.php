<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_forbids_to_create_a_comment_if_invalid_password_is_sent_or_password_is_not_sent()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/users/comments', [
            'id' => $user->id,
            'comment' => 'Comment one'
        ]);
        
        $response->assertForbidden();
    }

    public function test_it_fails_validation_if_user_id_is_not_sent()
    {

        $response = $this->json('POST', '/users/comments', [
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
                'comments' => 'Comment one'
            ]);

        $response->assertStatus(422);
    }

    public function test_it_fails_validation_if_invalid_user_id_is_sent()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/users/comments', [
                'id' => 2,
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
                'comments' => 'Comment one'
            ]);

        $response->assertStatus(422);
    }

    public function test_it_stores_a_comment_of_an_user()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/users/comments', [
                'id' => $user->id,
                'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
                'comments' => 'Comment two'
            ]);

        $response->assertStatus(200);
    }
}
