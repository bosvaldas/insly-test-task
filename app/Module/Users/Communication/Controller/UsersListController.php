<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Module\Users\Business\Reader\UsersReaderInterface;
use App\Module\Users\Communication\Output\UsersOutputFactory;
use Illuminate\Http\JsonResponse;

class UsersListController
{
    public function __construct(
        private readonly UsersReaderInterface $usersReader,
        private readonly UsersOutputFactory $usersOutputFactory,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $users = $this->usersReader->list();
        $output = $this->usersOutputFactory->createFromUsersCollection($users);

        return new JsonResponse($output);
    }
}
