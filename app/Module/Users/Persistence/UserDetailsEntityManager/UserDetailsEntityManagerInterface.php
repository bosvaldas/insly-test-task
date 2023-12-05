<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsEntityManager;

use App\Models\User;
use App\Models\UserDetail;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;

interface UserDetailsEntityManagerInterface
{
    public function create(UsersCreateInput $input, User $user): UserDetail;

    public function update(UsersUpdateInput $input, User $user): UserDetail;

    public function deleteByUserId(int $userId): void;
}
