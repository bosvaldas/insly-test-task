<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersEntityManager;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;

interface UsersEntityManagerInterface
{
    public function create(UsersCreateInput $input): User;
}
