<?php

declare(strict_types=1);

namespace App\Module\Users\Business\Writer;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersDeleteInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;

interface UsersWriterInterface
{
    public function create(UsersCreateInput $input): User;

    public function update(UsersUpdateInput $input): User;

    public function delete(UsersDeleteInput $input): void;
}
