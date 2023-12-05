<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Controller;

use App\Module\Users\Business\Writer\UsersWriterInterface;
use App\Module\Users\Communication\Request\UsersDeleteRequest;
use Illuminate\Http\JsonResponse;

class UsersDeleteController
{
    public function __construct(
        private readonly UsersWriterInterface $usersWriter,
    ) {
    }

    public function __invoke(UsersDeleteRequest $request): JsonResponse
    {
        $input = $request->toInput();
        $this->usersWriter->delete($input);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
