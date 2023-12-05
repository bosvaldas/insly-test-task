<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Input;

class UsersCreateInput
{
    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public ?string $address,
    ) {
    }
}
