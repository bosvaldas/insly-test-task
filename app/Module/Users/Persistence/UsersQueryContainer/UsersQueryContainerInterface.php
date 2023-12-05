<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersQueryContainer;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface UsersQueryContainerInterface
{
    public function queryById(int $id): Builder;
}
