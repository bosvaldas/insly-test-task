<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersEntityManager;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;
use App\Module\Users\Persistence\UsersQueryContainer\UsersQueryContainerInterface;

class UsersEntityManager implements UsersEntityManagerInterface
{
    public function __construct(
        private readonly UsersQueryContainerInterface $usersQueryContainer,
    ) {
    }

    public function create(UsersCreateInput $input): User
    {
        $user = new User();
        $user->email = $input->email;
        $user->password = bcrypt($input->email);
        $user->first_name = $input->firstName;
        $user->last_name = $input->lastName;
        $user->save();

        return $user;
    }

    public function update(UsersUpdateInput $input): User
    {
        $user = $this->usersQueryContainer
            ->queryById($input->id)
            ->firstOrFail();
        assert($user instanceof User);

        $user->email = $input->email;
        $user->password = bcrypt($input->email);
        $user->first_name = $input->firstName;
        $user->last_name = $input->lastName;
        $user->save();

        return $user;
    }
}
