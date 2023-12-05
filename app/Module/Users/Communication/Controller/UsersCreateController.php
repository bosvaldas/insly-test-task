<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Module\Users\Business\Writer\UsersWriterInterface;
use App\Module\Users\Communication\Output\UsersOutput;
use App\Module\Users\Communication\Request\UsersCreateRequest;
use Illuminate\Http\JsonResponse;

class UsersCreateController
{
    public function __construct(
        private readonly UsersWriterInterface $usersWriter,
    ) {
    }

    public function __invoke(UsersCreateRequest $request): JsonResponse
    {
        $input = $request->toInput();
        $user = $this->usersWriter->create($input);
        $output = UsersOutput::fromUser($user);

        return new JsonResponse($output, JsonResponse::HTTP_CREATED);
    }
}
