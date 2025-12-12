<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;

readonly class PermissionDTO
{
    public function __construct(
        public string $name,
        public string $guardName,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        $data = $request->validated();

        return new self(
            name: $data['name'],
            guardName: $data['guard_name'] ?? config('auth.defaults.guard'),
        );
    }
}
