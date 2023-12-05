<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsQueryContainer;

use Illuminate\Database\Eloquent\Builder;

interface UserDetailsQueryContainerInterface
{
    public function queryByUserId(int $userId): Builder;
}
