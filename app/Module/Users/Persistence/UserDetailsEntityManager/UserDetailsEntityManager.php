<?php

declare(strict_types=1);

namespace App\Module\Users\Persistence\UserDetailsEntityManager;

use App\Models\User;
use App\Models\UserDetail;
use App\Module\Users\Communication\Input\UsersCreateInput;
use App\Module\Users\Communication\Input\UsersUpdateInput;
use App\Module\Users\Persistence\UserDetailsQueryContainer\UserDetailsQueryContainerInterface;

class UserDetailsEntityManager implements UserDetailsEntityManagerInterface
{
    public function __construct(
        private readonly UserDetailsQueryContainerInterface $userDetailsQueryContainer,
    ) {
    }

    public function create(UsersCreateInput $input, User $user): UserDetail
    {
        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->address = $input->address;
        $userDetail->save();

        return $userDetail;
    }

    public function update(UsersUpdateInput $input, User $user): UserDetail
    {
        $userDetail = $this->userDetailsQueryContainer
            ->queryByUserId($user->id)
            ->firstOrNew();
        assert($userDetail instanceof UserDetail);

        $userDetail->user_id = $user->id;
        $userDetail->address = $input->address;
        $userDetail->save();

        return $userDetail;
    }

    public function deleteByUser(User $user): void
    {
        $this->userDetailsQueryContainer
            ->queryByUserId($user->id)
            ->delete();
    }
}
