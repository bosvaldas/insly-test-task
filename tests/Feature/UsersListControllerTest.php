<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_emptyResponse_whenDatabaseIsEmpty(): void
    {
        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $response->assertOk();
        $response->assertExactJson([]);
    }

    public function test_response_whenDatabaseHas1User(): void
    {
        // Arrange
        $user = User::factory()
            ->has(UserDetail::factory())
            ->create();

        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $response->assertOk();
        $response->assertJson([
            [
                'id' => $user->id,
                'address' => $user->userDetail->address,
            ],
        ]);
    }

    public function test_response_whenDatabaseHas3Users(): void
    {
        // Arrange
        $user1 = User::factory()
            ->has(UserDetail::factory())
            ->create();
        $user2 = User::factory()
            ->create();
        $user3 = User::factory()
            ->has(UserDetail::factory())
            ->create();

        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $response->assertOk();
        $response->assertJson([
            [
                'id' => $user1->id,
                'address' => $user1->userDetail->address,
            ],
            [
                'id' => $user2->id,
                'address' => null,
            ],
            [
                'id' => $user3->id,
                'address' => $user3->userDetail->address,
            ],
        ]);
    }
}
