<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersEntityManager;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;

interface UsersEntityManagerInterface
{
    public function create(UsersCreateInput $input): User;

    public function update(UsersUpdateInput $input): User;

    public function deleteById(int $id): void;
}
