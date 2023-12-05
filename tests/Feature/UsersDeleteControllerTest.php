<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserDetail;
use Tests\TestCase;

class UsersDeleteControllerTest extends TestCase
{
    // no user
    public function test_returns404_whenUserDoesNotExist(): void
    {
        // Act
        $response = $this->deleteJson('/api/users/' . 12345);

        // Assert
        $response->assertNotFound();
    }

    public function test_deletesUser_whenUserHasNoDetails(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->deleteJson('/api/users/' . $user->id);

        // Assert
        $response->assertNoContent();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_deletesUser_whenUserHasDetails(): void
    {
        // Arrange
        $user = User::factory()
            ->has(UserDetail::factory())
            ->create();

        // Act
        $response = $this->deleteJson('/api/users/' . $user->id);

        // Assert
        $response->assertNoContent();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('user_details', ['user_id' => $user->id]);
    }
}
