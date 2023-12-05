<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsEntityManager;

use App\Models\User;
use App\Models\UserDetail;
use App\Module\Users\Communication\Input\UsersCreateInput;

class UserDetailsEntityManager implements UserDetailsEntityManagerInterface
{
    public function create(UsersCreateInput $input, User $user): UserDetail
    {
        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->address = $input->address;
        $userDetail->save();

        return $userDetail;
    }
}
