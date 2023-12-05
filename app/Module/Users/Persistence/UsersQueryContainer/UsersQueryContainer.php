<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UsersQueryContainer;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UsersQueryContainer implements UsersQueryContainerInterface
{
    private function create(): Builder
    {
        return User::query();
    }

    public function queryById(int $id): Builder
    {
        return $this->create()
            ->where('id', '=', $id);
    }
}
