<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Models\User;
use App\Module\Users\Business\Reader\UsersReaderInterface;
use App\Module\Users\Communication\Output\UsersOutput;
use Illuminate\Http\JsonResponse;

class UsersListController
{
    public function __construct(
        private readonly UsersReaderInterface $usersReader,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $users = $this->usersReader
            ->list()
            ->map(fn (User $user) => UsersOutput::fromUser($user));

        return new JsonResponse($users);
    }
}
