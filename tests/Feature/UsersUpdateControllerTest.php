<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns404_whenUserDoesNotExist(): void
    {
        // Arrange
        $data = [
            'email' => 'foo@bar.baz',
            'password' => 'secret123',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        // Act
        $response = $this->putJson('/api/users/' . 12345, $data);

        // Assert
        $response->assertNotFound();
    }

    public function test_updatesAndReturnsUser_withoutOptionalFields(): void
    {
        // Arrange
        $user = User::factory()->create();

        $data = [
            'email' => 'foo@bar.baz',
            'password' => 'secret123',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        // Act
        $response = $this->putJson('/api/users/' . $user->id, $data);

        // Assert - response contains the updated user
        $response->assertOk();

        $responseJson = $response->json();
        $this->assertArrayNotHasKey('password', $responseJson);
        $this->assertNotNull($responseJson['id']);
        $this->assertSame('foo@bar.baz', $responseJson['email']);
        $this->assertSame('John', $responseJson['firstName']);
        $this->assertSame('Doe', $responseJson['lastName']);
        $this->assertNull($responseJson['address']);

        // Assert - user is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'foo@bar.baz',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    public function test_updatesAndReturnsUser_withAllFields_whenUserDoesNotHaveAnAddress(): void
    {
        // Arrange
        $user = User::factory()->create();

        $data = [
            'email' => 'bob@doe.test',
            'password' => 'changeMe',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
            'address' => 'Testing st. 14, Vilnius, Lithuania',
        ];

        // Act
        $response = $this->putJson('/api/users/' . $user->id, $data);

        // Assert - response contains the updated user
        $response->assertOk();

        $responseJson = $response->json();
        $this->assertArrayNotHasKey('password', $responseJson);
        $this->assertNotNull($responseJson['id']);
        $this->assertSame('bob@doe.test', $responseJson['email']);
        $this->assertSame('BOB', $responseJson['firstName']);
        $this->assertSame('Doe', $responseJson['lastName']);

        // Assert - user details are in the response
        $this->assertSame('Testing st. 14, Vilnius, Lithuania', $responseJson['address']);

        // Assert - user is updated in the database
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

    public function test_updatesAndReturnsUser_withAllFields_whenUserAlreadyHasAnAddress(): void
    {
        // Arrange
        $user = User::factory()
            ->has(UserDetail::factory())
            ->create();

        $data = [
            'email' => 'bob@doe.test',
            'password' => 'changeMe',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
            'address' => 'Testing st. 14, Vilnius, Lithuania',
        ];

        // Act
        $response = $this->putJson('/api/users/' . $user->id, $data);

        // Assert - response contains the updated user
        $response->assertOk();

        $responseJson = $response->json();
        $this->assertArrayNotHasKey('password', $responseJson);
        $this->assertNotNull($responseJson['id']);
        $this->assertSame('bob@doe.test', $responseJson['email']);
        $this->assertSame('BOB', $responseJson['firstName']);
        $this->assertSame('Doe', $responseJson['lastName']);

        // Assert - user details are in the response
        $this->assertSame('Testing st. 14, Vilnius, Lithuania', $responseJson['address']);

        // Assert - user is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $responseJson['id'],
            'email' => 'bob@doe.test',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
        ]);

        // Assert - user details are saved
        $this->assertDatabaseHas('user_details', [
            'id' => $user->userDetail->id,
            'address' => 'Testing st. 14, Vilnius, Lithuania',
            'user_id' => $responseJson['id'],
        ]);
    }

    public function test_deletesOldDetails_whenUpdatingWithoutAnAddress(): void
    {
        // Arrange
        $user = User::factory()
            ->has(UserDetail::factory())
            ->create();

        $userDetailId = $user->userDetail->id;

        $data = [
            'email' => 'bob@doe.test',
            'password' => 'changeMe',
            'first_name' => 'BOB',
            'last_name' => 'Doe',
        ];

        // Act
        $this->putJson('/api/users/' . $user->id, $data);

        // Assert - user details are deleted
        $this->assertDatabaseMissing('user_details', [
            'id' => $userDetailId,
        ]);
    }

    /**
     * @dataProvider failingValidationDataProvider
     */
    public function test_failsValidation(array $data): void
    {
        // Act
        $response = $this->putJson('/api/users/1', $data);

        // Assert
        $response->assertUnprocessable();
    }

    public static function failingValidationDataProvider(): array
    {
        $validBody = [
            'email' => 'foo@bar.baz',
            'password' => 'secret123',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $makeBodyWith = function (string $key, mixed $value) use ($validBody) {
            $body = $validBody;
            $body[$key] = $value;

            return $body;
        };

        $makeBodyWithout = function (string $key) use ($validBody) {
            $body = $validBody;
            unset($body[$key]);

            return $body;
        };

        $longString = str_repeat('a', 256);

        return [
            'empty request body' => [[]],

            'missing email' => [$makeBodyWithout('email')],
            'not string email' => [$makeBodyWith('email', 5)],
            'invalid email' => [$makeBodyWith('email', 'test')],
            'long email' => [$makeBodyWith('email', sprintf('%s@%s', $longString, 'test.com'))],

            'missing password' => [$makeBodyWithout('password')],
            'not string password' => [$makeBodyWith('password', 12345)],
            'empty password' => [$makeBodyWith('password', '')],
            'long password' => [$makeBodyWith('password', $longString)],

            'missing first_name' => [$makeBodyWithout('first_name')],
            'not string first_name' => [$makeBodyWith('first_name', 12345)],
            'empty first_name' => [$makeBodyWith('first_name', '')],
            'long first_name' => [$makeBodyWith('first_name', $longString)],

            'missing last_name' => [$makeBodyWithout('last_name')],
            'not string last_name' => [$makeBodyWith('last_name', 12345)],
            'empty last_name' => [$makeBodyWith('last_name', '')],
            'long last_name' => [$makeBodyWith('last_name', $longString)],

            'not string address' => [$makeBodyWith('address', 12345)],
            'long address' => [$makeBodyWith('address', $longString)],
        ];
    }
}
