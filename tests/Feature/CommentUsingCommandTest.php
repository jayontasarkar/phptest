<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentUsingCommandTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_creates_comment_using_command_if_parameters_are_given_properly()
    {
        $user = User::factory()->create();
        $response = Artisan::call('comment:create', [
            'id' => $user->id,
            'comment' => $this->faker->sentence(2)
        ]);
        
        $this->assertEquals(1, $response);
    }

    public function test_it_throws_error_if_invalid_user_id_is_provided()
    {
        $user = User::factory()->create();
        $response = Artisan::call('comment:create', [
            'id' => 3,
            'comment' => $this->faker->sentence(2)
        ]);
        
        $this->assertEquals(0, $response);
    }

    public function test_it_throws_error_if_no_parameter_is_passed()
    {
        $this->expectException('Symfony\Component\Console\Exception\RuntimeException');
        Artisan::call('comment:create');
    }

    public function test_it_throws_error_if_user_id_isnot_passed()
    {
        $this->expectException('Symfony\Component\Console\Exception\RuntimeException');
        Artisan::call('comment:create', [
            'comment' => 'Comment one'
        ]);
    }

    public function test_it_throws_error_if_comment_is_not_passed()
    {
        $this->expectException('Symfony\Component\Console\Exception\RuntimeException');
        $user = User::factory()->create();
        Artisan::call('comment:create', [
            'id' => $user->id
        ]);
    }
}
