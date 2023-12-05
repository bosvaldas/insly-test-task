<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Models\User;
use App\Models\UserDetail;
use App\Module\Users\Communication\Request\UsersCreateRequest;
use Illuminate\Http\JsonResponse;

class UsersUpdateController
{
    public function __invoke(int $id, UsersCreateRequest $request): JsonResponse
    {
        $user = User::query()->findOrFail($id);
        assert($user instanceof User);

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('email'));
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        $address = $request->input('address');
        if ($address) {
            $userDetail = UserDetail::query()
                ->where('user_id', '=', $user->id)
                ->firstOrNew();
            $userDetail->user_id = $user->id;
            $userDetail->address = $address;
            $userDetail->save();
        } else {
            $userDetail = UserDetail::query()
                ->where('user_id', '=', $user->id)
                ->delete();
        }

        $data = $user->toArray();
        $data['address'] = $userDetail->address ?? null;

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
