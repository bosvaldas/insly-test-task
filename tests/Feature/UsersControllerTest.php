<?php

declare(strict_types=1);

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
        $this->assertNull($responseJson['address']);

        // Assert - user is saved to the database
        $this->assertDatabaseHas('users', [
            'id' => $responseJson['id'],
            'email' => 'foo@bar.baz',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /** @test */
    public function create_withAllFields_createsAndReturnsUser(): void
    {
        // Arrange
        $data = [
            'email' => 'bob@doe.test',
            'password' => 'changeMe',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
            'address' => 'Testing st. 14, Vilnius, Lithuania',
        ];

        // Act
        $response = $this->post('/api/users', $data);

        // Assert - response contains the created user
        $response->assertCreated();

        $responseJson = $response->json();
        $this->assertArrayNotHasKey('password', $responseJson);
        $this->assertNotNull($responseJson['id']);
        $this->assertSame('bob@doe.test', $responseJson['email']);
        $this->assertSame('BOB', $responseJson['first_name']);
        $this->assertSame('Doe', $responseJson['last_name']);

        // Assert - user details are in the response
        $this->assertSame('Testing st. 14, Vilnius, Lithuania', $responseJson['address']);

        // Assert - user is saved to the database
        $this->assertDatabaseHas('users', [
            'id' => $responseJson['id'],
            'email' => 'bob@doe.test',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
        ]);

        // Assert - user details are saved
        $this->assertDatabaseHas('user_details', [
            'address' => 'Testing st. 14, Vilnius, Lithuania',
            'user_id' => $responseJson['id'],
        ]);
    }

}
