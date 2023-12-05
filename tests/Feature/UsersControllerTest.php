<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_withoutOptionalFields_createsAndReturnsUser(): void
    {
        // Arrange
        $data = [
            'email' => 'foo@bar.baz',
            'password' => 'secret123',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        // Act
        $response = $this->post('/api/users', $data);

        // Assert - response contains the created user
        $response->assertCreated();

        $responseJson = $response->json();
        $this->assertArrayNotHasKey('password', $responseJson);
        $this->assertNotNull($responseJson['id']);
        $this->assertSame('foo@bar.baz', $responseJson['email']);
        $this->assertSame('John', $responseJson['first_name']);
        $this->assertSame('Doe', $responseJson['last_name']);

        // Assert - user is saved to the database
        $this->assertDatabaseHas('users', [
            'id' => $responseJson['id'],
            'email' => 'foo@bar.baz',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }
}
