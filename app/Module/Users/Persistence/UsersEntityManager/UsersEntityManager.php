<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersEntityManager;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;

class UsersEntityManager implements UsersEntityManagerInterface
{
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
}
