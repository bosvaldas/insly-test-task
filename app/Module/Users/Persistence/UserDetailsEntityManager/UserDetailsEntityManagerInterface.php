<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsEntityManager;

use App\Models\User;
use App\Models\UserDetail;
use App\Module\Users\Communication\Input\UsersCreateInput;

interface UserDetailsEntityManagerInterface
{
    public function create(UsersCreateInput $input, User $user): UserDetail;
}
