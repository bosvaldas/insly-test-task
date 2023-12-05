<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsQueryContainer;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Builder;

class UserDetailsQueryContainer implements UserDetailsQueryContainerInterface
{
    private function create(): Builder
    {
        return UserDetail::query();
    }

    public function queryByUserId(int $userId): Builder
    {
        return $this->create()
            ->where('user_id', '=', $userId);
    }
}
