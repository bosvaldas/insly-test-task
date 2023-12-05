<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Input;

class UsersUpdateInput
{
    public function __construct(
        public int $id,
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?string $address,
    ) {
    }
}
