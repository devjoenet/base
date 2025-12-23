<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Data\UserData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class StoreUserRequest extends FormRequest
{
    use WithData;

    public function authorize(): bool
    {
        // Permission check is already handled by route middleware ('can:manage users')
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ];
    }

    protected function dataClass(): string
    {
        return UserData::class;
    }
}
