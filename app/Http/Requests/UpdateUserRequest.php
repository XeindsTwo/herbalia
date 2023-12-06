<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'login' => 'required|string|min:5|max:60|unique:users,login,' . $userId,
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'required|string|min:8|max:60',
        ];
    }
}