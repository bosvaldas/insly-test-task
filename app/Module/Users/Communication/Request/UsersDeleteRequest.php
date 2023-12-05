<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Request;

use App\Module\Users\Communication\Input\UsersDeleteInput;
use Illuminate\Foundation\Http\FormRequest;

class UsersDeleteRequest extends FormRequest
{
    public function toInput(): UsersDeleteInput
    {
        return new UsersDeleteInput(
            id: (int) $this->route('id')
        );
    }
}
