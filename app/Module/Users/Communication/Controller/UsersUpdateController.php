<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Module\Users\Business\Writer\UsersWriterInterface;
use App\Module\Users\Communication\Request\UsersUpdateRequest;
use Illuminate\Http\JsonResponse;

class UsersUpdateController
{
    public function __construct(
        private readonly UsersWriterInterface $usersWriter,
    ) {
    }

    public function __invoke(UsersUpdateRequest $request): JsonResponse
    {
        $input = $request->toInput();

        $user = $this->usersWriter->update($input);

        $data = $user->toArray();
        $data['address'] = $user->userDetail->address ?? null;

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
