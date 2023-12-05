<?php

declare(strict_types=1);

namespace App\Module\Users\Business\Reader;

use App\Module\Users\Persistence\UsersQueryContainer\UsersQueryContainerInterface;
use Illuminate\Support\Collection;

class UsersReader implements UsersReaderInterface
{
    public function __construct(
        private readonly UsersQueryContainerInterface $usersQueryContainer,
    ) {
    }

    public function list(): Collection
    {
        return $this->usersQueryContainer
            ->create()
            ->get();
    }
}
