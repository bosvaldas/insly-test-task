<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersDeleteController
{
    public function __invoke(int $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);
        assert($user instanceof User);

        if ($user->userDetail) {
            $user->userDetail->delete();
        }

        $user->delete();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
