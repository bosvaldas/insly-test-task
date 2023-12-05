<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController
{
    public function create(Request $request): JsonResponse
    {
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('email'));
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        $address = $request->input('address');
        if ($address) {
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->address = $address;
            $userDetail->save();
        }

        $data = $user->toArray();
        $data['address'] = $userDetail->address ?? null;

        return new JsonResponse($data, JsonResponse::HTTP_CREATED);
    }
}
