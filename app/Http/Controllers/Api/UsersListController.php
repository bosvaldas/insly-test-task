<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersListController
{
    public function __invoke(): JsonResponse
    {
        $users = User::all()
            ->map(function (User $user): array {
                $data = $user->toArray();
                $data['address'] = $user->userDetail->address ?? null;

                return $data;
            });

        return new JsonResponse($users);
    }
}
