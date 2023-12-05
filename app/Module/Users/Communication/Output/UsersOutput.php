<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Output;

use App\Models\User;

class UsersOutput
{
    public function __construct(
        public int $id,
        public string $email,
        public string $firstName,
        public string $lastName,
        public ?string $address,
    ) {
    }

    public static function fromUser(User $user): static
    {
        return new static(
            id: $user->id,
            email: $user->email,
            firstName: $user->first_name,
            lastName: $user->last_name,
            address: $user->userDetail->address ?? null,
        );
    }
}
