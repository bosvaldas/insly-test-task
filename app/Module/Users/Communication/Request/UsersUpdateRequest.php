<?php

namespace App\Module\Users\Communication\Request;

use App\Module\Users\Communication\Input\UsersUpdateInput;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
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

    public function toInput(): UsersUpdateInput
    {
        return new UsersUpdateInput(
            id: $this->route('id'),
            email: $this->input('email'),
            password: $this->input('password'),
            firstName: $this->input('first_name'),
            lastName: $this->input('last_name'),
            address: $this->input('address'),
        );
    }
}
