<?php

declare(strict_types=1);

namespace App\Module\Users\Business\Writer;

use App\Models\User;
use App\Module\Users\Communication\Input\UsersCreateInput;

interface UsersWriterInterface
{
    public function create(UsersCreateInput $input): User;
}
