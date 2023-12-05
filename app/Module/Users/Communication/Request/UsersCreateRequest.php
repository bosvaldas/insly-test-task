<?php

namespace App\Module\Users\Communication\Request;

use App\Module\Users\Communication\Input\UsersCreateInput;
use Illuminate\Foundation\Http\FormRequest;

class UsersCreateRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'max:255'],
            'first_name' => ['required', 'string', 'min:1', 'max:255'],
            'last_name' => ['required', 'string', 'min:1', 'max:255'],
            'address' => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }

    public function toInput(): UsersCreateInput
    {
        return new UsersCreateInput(
            email: $this->input('email'),
            password: $this->input('password'),
            firstName: $this->input('first_name'),
            lastName: $this->input('last_name'),
            address: $this->input('address'),
        );
    }
}
