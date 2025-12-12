<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password,
        public ?string $role,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'), // Nullable for updates
            role: $request->validated('role'),
        );
    }
}
