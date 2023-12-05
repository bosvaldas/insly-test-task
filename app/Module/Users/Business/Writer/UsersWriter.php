<?php

declare(strict_types=1);

namespace App\Module\Users\Business\Writer;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersDeleteInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;
use App\Module\Users\Persistence\UserDetailsEntityManager\UserDetailsEntityManagerInterface;
use App\Module\Users\Persistence\UsersEntityManager\UsersEntityManagerInterface;

class UsersWriter implements UsersWriterInterface
{
    public function __construct(
        private readonly UsersEntityManagerInterface $usersEntityManager,
        private readonly UserDetailsEntityManagerInterface $userDetailsEntityManager,
    ) {
    }

    public function create(UsersCreateInput $input): User
    {
        $user = $this->usersEntityManager->create($input);

        if ($input->address) {
            $this->userDetailsEntityManager->create($input, $user);
        }

        return $user;
    }

    public function update(UsersUpdateInput $input): User
    {
        $user = $this->usersEntityManager->update($input);

        if ($input->address) {
            $this->userDetailsEntityManager->update($input, $user);
        } else {
            $this->userDetailsEntityManager->deleteByUserId($user->id);
        }

        return $user;
    }

    public function delete(UsersDeleteInput $input): void
    {
        $this->userDetailsEntityManager->deleteByUserId($input->id);
        $this->usersEntityManager->deleteById($input->id);
    }
}
