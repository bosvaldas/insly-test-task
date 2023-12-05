<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'max:255'],
            'first_name' => ['required', 'string', 'min:1', 'max:255'],
            'last_name' => ['required', 'string', 'min:1', 'max:255'],
            'address' => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }
}
