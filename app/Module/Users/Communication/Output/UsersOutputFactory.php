<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Output;

use App\Models\User;
use Illuminate\Support\Collection;

class UsersOutputFactory
{
    public function createFromUser(User $user): UsersOutput
    {
        return new UsersOutput(
            id: $user->id,
            email: $user->email,
            firstName: $user->first_name,
            lastName: $user->last_name,
            address: $user->userDetail->address ?? null,
        );
    }

    /**
     * @param \Illuminate\Support\Collection<\App\Models\User> $collection
     *
     * @return \Illuminate\Support\Collection<\App\Module\Users\Communication\Output\UsersOutput>
     */
    public function createFromUsersCollection(Collection $collection): Collection
    {
        return $collection->map([$this, 'createFromUser']);
    }
}
